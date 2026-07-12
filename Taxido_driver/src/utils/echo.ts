import Echo from 'laravel-echo';
import { getValue } from './localstorage';
import { URL } from '../api/config';


// @ts-ignore
const PusherClient = require('pusher-js/react-native').Pusher || require('pusher-js/react-native');

PusherClient.logToConsole = true;

// @ts-ignore
window.Pusher = PusherClient;

let echoInstance: any = null;
let cachedToken: string | null = null;

const getEchoInstance = async () => {
  const token = await getValue('token');

  if (echoInstance && cachedToken === token) {
    return echoInstance;
  }

  if (echoInstance) {
    try {
      echoInstance.disconnect();
    } catch (e) {
      console.error("Error disconnecting stale Echo instance:", e);
    }
  }

  cachedToken = token;

  echoInstance = new Echo({
    broadcaster: 'pusher',
    key: '',
    wsHost: '',
    wsPort: 443,
    wssPort: 443,
    forceTLS: true,
    disableStats: true,
    cluster: '',
    enabledTransports: ['ws', 'wss'],
    Pusher: PusherClient,
    authEndpoint: `${URL}/api/broadcasting/auth`,
    auth: {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: 'application/json',
      },
    },
  });

  if (echoInstance.connector.pusher) {
    echoInstance.connector.pusher.connection.bind('state_change', (states: any) => {
      console.log(`[Echo] Connection state changed from ${states.previous} to ${states.current}`);
    });
    echoInstance.connector.pusher.connection.bind('error', (err: any) => {
      console.error('[Echo] Connection error:', err);
      if (err?.error?.data?.code === 4004) {
        console.error('[Echo] Critical: Pusher app not found or wrong credentials.');
      }
    });
    echoInstance.connector.pusher.connection.bind('connected', () => {
      console.log('[Echo] Connected! Socket ID:', echoInstance.socketId());
    });
    echoInstance.connector.pusher.connection.bind('disconnected', () => {
      console.log('[Echo] Disconnected.');
    });
  }

  return echoInstance;
};

export const disconnectEcho = () => {
  if (echoInstance) {
    echoInstance.disconnect();
    echoInstance = null;
  }
};

export default getEchoInstance;
