@extends('taxido::front.account.master')
@section('title', __('taxido::front.support'))
@section('detailBox')
  <div class="dashboard-details-box">
    <div class="dashboard-title">
      <h3>{{ __('taxido::front.chat') }}</h3>
    </div>
    <div class="chatting-main-box">
      <div class="right-sidebar-chat">
        <div class="contentbox">
          <div class="inside">
            <div class="right-sidebar-title">
              <div class="common-space">
                <div class="chat-time-chat">
                  <div class="chat-top-box">
                    <div class="chat-profile">
                      <div id="receiverAvatarContainer">
                        @if ($admin?->profile_image?->original_url)
                            <img class="img-fluid rounded-circle" id="receiverAvatar"
                                src="{{ $admin->profile_image->original_url }}" alt="admin">
                        @else
                            <div class="user-round message-profile">
                                <span>{{ strtoupper($admin?->name[0]) }}</span>
                            </div>
                        @endif
                      </div>
                      <div id="receiverStatusDot"></div>
                    </div>
                    <div>
                      <h5 id="receiverName">{{ $admin?->name ?? 'Admin' }}</h5>
                    </div>
                    <div class="chatting-option">
                      <a href="javascript:void(0)" id="clearChat" data-bs-toggle="modal"
                          data-bs-target="#confirmation">
                          <i class="ri-brush-line"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="right-sidebar-Chats">
              <div class="message">
                <div class="msger-chat custom-scrollbar" id="messages">
                  <div id="loading">
                    <i class="fa fa-spinner fa-spin"></i>
                    {{ __('taxido::static.chats.load_message') }}
                  </div>
                  <div id="noMessages" class="no-chat-message">
                    <span>{{ __('taxido::static.chats.no_messages_yet') }}</span>
                  </div>
                  <div id="error"></div>
                </div>
                <form class="msger-inputarea">
                  <div class="position-relative">
                    <input class="msger-input" type="text" id="message" placeholder="{{ __('taxido::front.type_message') }}">
                    <i class="ri-error-warning-line msger-input-error-icon"></i>
                    <button class="msger-send-btn" type="button" id="send">
                      <i class="ri-send-plane-line"></i>
                    </button>
                    <input type="file" id="sendImage" accept="image/*" multiple style="display:none;">
                    <button type="button" id="uploadImage" class="gallery" style="margin-left: 10px;">
                      <i class="ri-image-line "></i>
                    </button>
                  </div>
                  <!-- Add Progress Bar -->
                </form>
                <div id="uploadProgress" class="progress mt-2" style="display:none;">
                  <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   <!-- Confirmation Modal -->
   <div class="modal theme-modal fade confirmation-modal" id="confirmation" tabindex="-1" role="dialog"
    aria-labelledby="confirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-start confirmation-data">
              <div class="main-img">
                  <div class="delete-icon">
                      <i class="ri-question-mark"></i>
                  </div>
              </div>
              <h4 class="modal-title">{{ __('taxido::static.chats.confirmation') }}</h4>
              <p>{{ __('taxido::static.chats.modal') }}</p>
            </div>
            <div class="modal-footer">
              <input type="hidden" id="inputType" name="type" value="">
              <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">No</button>
              <button type="button" class="btn gradient-bg-color" id="confirmDelete">Yes</button>
            </div>
        </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  const BASE_URL = "{{ url('/') }}";
  const ACCESS_TOKEN = "{{ $access_token }}";
  const MY_USER_ID = String("{{ auth()->user()?->id }}");
  const adminId = String("{{ $admin?->id }}");
  const currentChatRoomId = [MY_USER_ID, adminId].sort().join('_');

  let echo;

  $(document).ready(function() {
    initChat();
  });

  function initChat() {
    echo = window.Echo;
    
    // Listen to Room
    echo.private(`chat.room.${currentChatRoomId}`)
        .listen('.chat.message.sent', (e) => {
            appendMessage(e);
            scrollToBottom();
            markRoomAsRead();
        });

    // Listen for Global Unread Updates
    echo.private(`user.notifications.${MY_USER_ID}`)
        .listen('.unread.count.updated', (e) => {
            // Update total unread in header if needed
            fetch(`${BASE_URL}/api/chat/unread-count`, {
                headers: { 'Authorization': `Bearer ${ACCESS_TOKEN}`, 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(res => {
                if (res.status) {
                    $('.unread-count').text(res.total_unread); 
                }
            });
        });

    loadMessages();

    $('#send').on('click', sendMessage);
    $('#message').on('keypress', function(e) {
        if (e.which === 13) {
            sendMessage();
            return false;
        }
    });

    $('#uploadImage').on('click', () => $('#sendImage').click());
    $('#sendImage').on('change', function(e) {
        const files = e.target.files;
        if (files.length > 0) uploadAndSendImages(files);
    });

    $('#confirmDelete').on('click', function() {
        clearChat();
        $('#confirmation').modal('hide');
    });
  }

  function loadMessages() {
    $('#loading').show();
    $('#messages').empty();

    fetch(`${BASE_URL}/api/chat/messages?room_id=${currentChatRoomId}`, {
        headers: { 'Authorization': `Bearer ${ACCESS_TOKEN}`, 'Accept': 'application/json' }
    })
    .then(res => res.json())
    .then(res => {
        $('#loading').hide();
        if (res.data && res.data.length > 0) {
            $('#noMessages').hide();
            res.data.forEach(msg => appendMessage(msg));
            scrollToBottom();
        } else {
            $('#noMessages').show();
        }
    });
  }

  function sendMessage() {
    const $input = $('#message');
    const text = $input.val().trim();
    if (!text) return;

    fetch(`${BASE_URL}/api/chat/send`, {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${ACCESS_TOKEN}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            room_id: currentChatRoomId,
            receiver_id: adminId,
            message: text
        })
    })
    .then(res => res.json())
    .then(res => {
        if (res.status) {
            appendMessage(res.data);
            scrollToBottom();
            $input.val('');
        }
    });
  }

  function appendMessage(msg) {
    const isMe = String(msg.sender_id) === MY_USER_ID;
    const bubbleClass = isMe ? 'admin-reply' : 'user-reply';
    const myUserImage = "{{ auth()->user()?->profile_image?->original_url ?? '' }}";
    const adminImage = "{{ $admin?->profile_image?->original_url ?? '' }}";
    const imageSrc = isMe ? myUserImage : adminImage;
    const nameInitial = isMe ? "{{ auth()->user()?->name[0] }}" : "{{ $admin?->name[0] }}";

    const imageHtml = imageSrc ?
      `<img src="${imageSrc}" class="message-profile img-fluid" alt="">` :
      `<div class="user-round message-profile"><h6>${nameInitial.toUpperCase()}</h6></div>`;

    let content = msg.message ? `<p>${msg.message}</p>` : '';
    if (msg.images && msg.images.length > 0) {
        content += msg.images.map(img => `<img src="${img}" class="chat-image img-fluid" alt="Chat image">`).join('');
    }

    const html = `
      <div class="${bubbleClass}">
        ${imageHtml}
        <div class="chatting-box">
          ${content}
          <h6 class="timing">${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</h6>
        </div>
      </div>
    `;

    $('#messages').append(html);
    $('#noMessages').hide();
  }

  function scrollToBottom() {
    const el = document.getElementById('messages');
    el.scrollTop = el.scrollHeight;
  }

  function markRoomAsRead() {
    fetch(`${BASE_URL}/api/chat/messages?room_id=${currentChatRoomId}`, {
        headers: { 'Authorization': `Bearer ${ACCESS_TOKEN}`, 'Accept': 'application/json' }
    });
  }

  async function uploadAndSendImages(files) {
    $('#uploadProgress').show();
    const urls = [];
    for (let file of files) {
        const formData = new FormData();
        formData.append('image', file);
        try {
            const res = await fetch(`${BASE_URL}/api/chat/upload`, {
                method: 'POST',
                headers: { 'Authorization': `Bearer ${ACCESS_TOKEN}` },
                body: formData
            });
            const data = await res.json();
            if (data.url) urls.push(data.url);
        } catch (e) {}
    }

    if (urls.length > 0) {
        fetch(`${BASE_URL}/api/chat/send`, {
            method: 'POST',
            headers: { 'Authorization': `Bearer ${ACCESS_TOKEN}`, 'Content-Type': 'application/json' },
            body: JSON.stringify({ room_id: currentChatRoomId, receiver_id: adminId, images: urls })
        }).then(res => res.json()).then(res => { if(res.status) appendMessage(res.data); scrollToBottom(); });
    }
    $('#uploadProgress').hide();
    $('#sendImage').val('');
  }

  function clearChat() {
    fetch(`${BASE_URL}/api/chat/clear`, {
        method: 'POST',
        headers: { 'Authorization': `Bearer ${ACCESS_TOKEN}`, 'Content-Type': 'application/json' },
        body: JSON.stringify({ room_id: currentChatRoomId })
    }).then(() => { $('#messages').empty(); $('#noMessages').show(); });
  }

</script>
@endpush
