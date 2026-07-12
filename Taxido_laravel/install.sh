#!/bin/bash

# ==============================================================================
# VPS AUTO INSTALLER
# ==============================================================================
# Designed for Ubuntu 22.04 / 24.04
# High-end, Colorful, and Interactive CLI Experience
# ==============================================================================

set -e

# Prevent interactive prompts during apt installations
export DEBIAN_FRONTEND=noninteractive
export UC_ALLOW_REBOOT=1

# --- Premium Color Palette & Theme Engine ---
declare -a VIBRANT_COLORS=(
    "\033[38;5;196m" # Red
    "\033[38;5;208m" # Orange
    "\033[38;5;220m" # Yellow
    "\033[38;5;82m"  # Light Green
    "\033[38;5;51m"  # Cyan
    "\033[38;5;27m"  # Blue
    "\033[38;5;201m" # Magenta
    "\033[38;5;213m" # Pink
)

# Pick a random color for this run
THEME_COLOR=${VIBRANT_COLORS[$RANDOM % ${#VIBRANT_COLORS[@]}]}
NC='\033[0m'
BOLD='\033[1m'
DIM='\033[2m'
ITALIC='\033[3m'
UNDERLINE='\033[4m'
BLINK='\033[5m'
RED='\033[0;31m'
GREEN='\033[0;32m'

# Icons
CHECK="✔"
CROSS="✖"
ARROW="➜"
INFO="ℹ"
LOCK="🔒"
GLOBE="🌐"
DATABASE="🗄️"
GEAR="⚙️"
STAR="⭐"

# Log file
INSTALL_LOG="/tmp/vps_install_$(date +%Y%m%d_%H%M%S).log"

# --- Detect App Name ---
PROJECT_PATH=$(pwd)
if [ -f ".env" ]; then
    APP_NAME=$(grep "^APP_NAME=" .env | cut -d '=' -f2 | tr -d '"' | tr -d "'")
fi
APP_NAME=${APP_NAME:-"LARAVEL"}
APP_SLUG=$(echo "$APP_NAME" | tr '[:upper:]' '[:lower:]' | sed 's/[^a-z0-9]/-/g')

# Current Step Tracker
CURRENT_STEP=0
TOTAL_STEPS=12
declare -a STEP_NAMES=(
    "System Update"
    "Basic Dependencies"
    "PHP 8.3 & Extensions"
    "Stack Installation (Nginx, MySQL, Redis)"
    "Database Configuration"
    "Node.js (LTS) & NPM"
    "Composer Installation"
    "Project Build (Vite & Deps)"
    "Nginx Virtual Host Setup"
    "Permissions & .env"
    "Supervisor (Queues & Reverb)"
    "Final Optimizations"
)

# --- UI Helper Functions ---

clear_screen() {
    clear
}

draw_banner() {
    echo -e "${THEME_COLOR}${BOLD}"
    echo "  ╔════════════════════════════════════════════════════════════════════╗"
    echo "  ║                                                                    ║"
    echo "  ║   $(printf '%-64s' "$APP_NAME INSTALLER") ║"
    echo "  ║   $(printf '%-64s' "PREMIUM VPS AUTO-DEPLOYMENT TOOL") ║"
    echo "  ║                                                                    ║"
    echo "  ╚════════════════════════════════════════════════════════════════════╝"
    echo -e "${NC}"
}

draw_box_top() {
    local title="$1"
    local width=70
    echo -ne "${THEME_COLOR}┌─[ ${BOLD}${title}${NC}${THEME_COLOR} ]"
    local title_len=${#title}
    local remaining=$((width - title_len - 6))
    for ((i=0; i<remaining; i++)); do echo -n "─"; done
    echo -e "┐${NC}"
}

draw_box_bottom() {
    echo -e "${THEME_COLOR}└"$(printf '─%.0s' {1..70})"┘${NC}"
}

print_line() {
    echo -e "${THEME_COLOR}│${NC} $1"
}

update_dashboard() {
    clear_screen
    draw_banner
    echo -e " ${BOLD}INSTALLATION PROGRESS${NC}"
    echo ""
    for i in "${!STEP_NAMES[@]}"; do
        local step_num=$((i + 1))
        if [ $step_num -lt $CURRENT_STEP ]; then
            echo -e "  ${THEME_COLOR}${CHECK}${NC} ${DIM}${step_num}. ${STEP_NAMES[$i]}${NC}"
        elif [ $step_num -eq $CURRENT_STEP ]; then
            echo -e "  ${THEME_COLOR}${BOLD}${ARROW} ${step_num}. ${STEP_NAMES[$i]}${NC} ${BLINK}...${NC}"
        else
            echo -e "    ${DIM}${step_num}. ${STEP_NAMES[$i]}${NC}"
        fi
    done
    echo ""
    echo -e " ${DIM}Logs are being saved to: ${INSTALL_LOG}${NC}"
}

start_step() {
    CURRENT_STEP=$((CURRENT_STEP + 1))
    update_dashboard
    draw_box_top "STEP ${CURRENT_STEP}: ${STEP_NAMES[$((CURRENT_STEP-1))]}"
}

finish_step() {
    draw_box_bottom
    sleep 0.5
}

show_spinner() {
    local pid=$1
    local delay=0.1
    local spinstr='|/-\'
    while kill -0 $pid 2>/dev/null; do
        local temp=${spinstr#?}
        printf " [%c]  " "$spinstr"
        local spinstr=$temp${spinstr%"$temp"}
        sleep $delay
        printf "\b\b\b\b\b\b"
    done
    printf "    \b\b\b\b"
}

wait_for_apt() {
    print_line "Checking for system locks (apt/dpkg)..."
    while fuser /var/lib/dpkg/lock-frontend >/dev/null 2>&1 || fuser /var/lib/apt/lists/lock >/dev/null 2>&1; do
        echo -ne "."
        sleep 1
    done
}

run_step_command() {
    local msg="$1"
    shift
    print_line "${msg}"
    "$@" >> "$INSTALL_LOG" 2>&1 &
    show_spinner $!

    # Check if the command actually failed
    if [ $? -ne 0 ]; then
        echo -e "\n${RED}${BOLD}${CROSS} Command Failed! Check logs at: ${INSTALL_LOG}${NC}"
        # We don't exit immediately so the user can see what failed
    fi
}

update_env_var() {
    local key="$1"
    local value="$2"
    if grep -q "^${key}=" .env; then
        sed -i "s|^${key}=.*|${key}=${value}|" .env
    else
        echo "${key}=${value}" >> .env
    fi
}

# --- Initial Checks & Warnings ---

clear_screen
draw_banner
draw_box_top "IMPORTANT: PRE-INSTALLATION CHECK"
echo -e "${RED}${BOLD}"
print_line "⚠️  This script is strictly designed for UBUNTU SERVER (22.04 or 24.04)."
print_line "⚠️  DO NOT run this on other Linux distributions."
print_line ""
echo -ne "${NC}${THEME_COLOR}"
print_line "1. Ensure your DOMAIN DNS is already pointed to this Server IP."
print_line "2. Ensure you have at least 2GB of RAM available."
print_line "3. After this script, you MUST complete the GUI OR CLI Installer at:"
print_line "   http://yourdomain.com/install or php artisan web:install"
echo -e "${NC}"
draw_box_bottom

echo -ne "\n${BOLD}Are you ready to proceed? (y/n):${NC} "
read PROCEED
if [[ ! $PROCEED =~ ^[Yy]$ ]]; then
    echo -e "\n${RED}Installation cancelled.${NC}"
    exit 0
fi

if [ "$EUID" -ne 0 ]; then
  draw_box_top "ERROR"
  print_line "${RED}${BOLD}${CROSS} Error: Please run as root (use sudo).${NC}"
  draw_box_bottom
  exit 1
fi

if [ ! -f "artisan" ]; then
    draw_box_top "ERROR"
    print_line "${RED}${BOLD}${CROSS} Error: 'artisan' file not found.${NC}"
    print_line "Run this script from your project root."
    draw_box_bottom
    exit 1
fi

# --- Setup Wizard ---

clear_screen
draw_banner
draw_box_top "SETUP WIZARD"
print_line "${BOLD}Welcome to the ${APP_NAME} Auto-Installer!${NC}"
print_line "Please provide the following details to configure your server."
echo -e "${THEME_COLOR}├──────────────────────────────────────────────────────────────────────────┤${NC}"

echo -ne "${THEME_COLOR}│${NC} ${BOLD}${GEAR} Application Name [${APP_NAME}]:${NC} "
read NEW_APP_NAME
APP_NAME=${NEW_APP_NAME:-$APP_NAME}
APP_SLUG=$(echo "$APP_NAME" | tr '[:upper:]' '[:lower:]' | sed 's/[^a-z0-9]/-/g')

echo -ne "${THEME_COLOR}│${NC} ${BOLD}${GLOBE} Domain Name (e.g. example.com):${NC} "
read DOMAIN_NAME
if [ -z "$DOMAIN_NAME" ]; then
    print_line "${RED}Error: Domain is required.${NC}"
    exit 1
fi

echo -ne "${THEME_COLOR}│${NC} ${BOLD}${DATABASE} Database Name [${APP_SLUG}]:${NC} "
read DB_NAME
DB_NAME=${DB_NAME:-$APP_SLUG}

echo -ne "${THEME_COLOR}│${NC} ${BOLD}${DATABASE} Database User [${APP_SLUG}_user]:${NC} "
read DB_USER
DB_USER=${DB_USER:-"${APP_SLUG}_user"}

echo -ne "${THEME_COLOR}│${NC} ${BOLD}${LOCK} Database Password:${NC} "
read -s DB_PASS
echo ""

echo -ne "${THEME_COLOR}│${NC} ${BOLD}${GEAR} Reverb Host [${DOMAIN_NAME}]:${NC} "
read REVERB_HOST
REVERB_HOST=${REVERB_HOST:-$DOMAIN_NAME}

draw_box_bottom

print_line "${THEME_COLOR}${BOLD}All set! Starting installation...${NC}"
sleep 1

# --- Execution Steps ---

# 1. System Update
start_step
wait_for_apt
run_step_command "Updating repositories..." apt-get update
run_step_command "Upgrading system (non-interactive)..." apt-get -y -o Dpkg::Options::="--force-confdef" -o Dpkg::Options::="--force-confold" upgrade
finish_step

# 2. Dependencies
start_step
run_step_command "Installing base dependencies..." apt-get install -y software-properties-common curl git unzip zip supervisor ufw build-essential libpng-dev libjpeg-dev libfreetype6-dev
finish_step

# 3. PHP 8.3
start_step
print_line "Adding PHP repository..."
add-apt-repository ppa:ondrej/php -y >> "$INSTALL_LOG" 2>&1
run_step_command "Installing PHP 8.3 & Extensions..." apt-get install -y php8.3-fpm php8.3-mysql php8.3-xml php8.3-mbstring php8.3-curl php8.3-zip php8.3-bcmath php8.3-intl php8.3-gd php8.3-redis php8.3-sqlite3 php8.3-common
finish_step

# 4. LEMP Stack
start_step
run_step_command "Installing Nginx, MySQL, Redis..." apt-get install -y nginx mysql-server redis-server
finish_step

# 5. Database Config
start_step
print_line "Configuring MySQL..."
mysql -e "CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\`;" >> "$INSTALL_LOG" 2>&1
mysql -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';" >> "$INSTALL_LOG" 2>&1
mysql -e "GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'localhost';" >> "$INSTALL_LOG" 2>&1
mysql -e "FLUSH PRIVILEGES;" >> "$INSTALL_LOG" 2>&1
finish_step

# 6. Node.js
start_step
run_step_command "Setting up NodeSource..." sh -c "curl -fsSL https://deb.nodesource.com/setup_20.x | bash -"
run_step_command "Installing Node.js 20..." apt-get install -y nodejs
finish_step

# 7. Composer
start_step
if ! [ -x "$(command -v composer)" ]; then
    run_step_command "Installing Composer..." sh -c "curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer"
else
    print_line "Composer already present."
fi
finish_step

# 8. Project Build
start_step
print_line "Setting directory ownership..."
chown -R www-data:www-data ${PROJECT_PATH} >> "$INSTALL_LOG" 2>&1
chmod -R 775 ${PROJECT_PATH}/storage ${PROJECT_PATH}/bootstrap/cache >> "$INSTALL_LOG" 2>&1

print_line "Composer Install (Dependencies)..."
export COMPOSER_ALLOW_SUPERUSER=1
composer install --no-dev --optimize-autoloader >> "$INSTALL_LOG" 2>&1

print_line "NPM Install (Frontend)..."
npm install >> "$INSTALL_LOG" 2>&1

run_step_command "Vite Build (Production)..." npm run build
finish_step

# 9. Nginx Config
start_step
print_line "Applying Nginx config..."
NGINX_CONF="/etc/nginx/sites-available/${DOMAIN_NAME}"
cat <<EOF > $NGINX_CONF
server {
    listen 80;
    server_name ${DOMAIN_NAME};
    root ${PROJECT_PATH}/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.php;
    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    # Reverb WebSockets Proxy
    location /reverb {
        proxy_pass http://127.0.0.1:8080;
        proxy_http_version 1.1;
        proxy_set_header Upgrade \$http_upgrade;
        proxy_set_header Connection "Upgrade";
        proxy_set_header Host \$host;
        proxy_cache_bypass \$http_upgrade;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF
ln -s $NGINX_CONF /etc/nginx/sites-enabled/ >/dev/null 2>&1 || true
rm -f /etc/nginx/sites-enabled/default
nginx -t >> "$INSTALL_LOG" 2>&1 && systemctl reload nginx >> "$INSTALL_LOG" 2>&1
finish_step

# 10. Permissions & .env
start_step
print_line "Configuring environment..."
[ ! -f .env ] && cp .env.example .env

update_env_var "APP_NAME" "\"$APP_NAME\""
update_env_var "APP_URL" "http://${DOMAIN_NAME}"
update_env_var "DB_DATABASE" "${DB_NAME}"
update_env_var "DB_USERNAME" "${DB_USER}"
update_env_var "DB_PASSWORD" "\"${DB_PASS}\""
update_env_var "VITE_REVERB_HOST" "${DOMAIN_NAME}"
update_env_var "BROADCAST_CONNECTION" "reverb"
update_env_var "QUEUE_CONNECTION" "redis"

run_step_command "Generating App Key..." php artisan key:generate --force
chown -R www-data:www-data ${PROJECT_PATH} >> "$INSTALL_LOG" 2>&1
chmod -R 775 ${PROJECT_PATH}/storage ${PROJECT_PATH}/bootstrap/cache >> "$INSTALL_LOG" 2>&1
finish_step

# 11. Supervisor
start_step
if [ -f "/etc/supervisor/conf.d/${APP_SLUG}-reverb.conf" ] && [ -f "/etc/supervisor/conf.d/${APP_SLUG}-worker.conf" ]; then
    print_line "Supervisor configs already exist. Skipping creation..."
else
    print_line "Creating Supervisor configuration files..."
    cat <<EOF > /etc/supervisor/conf.d/${APP_SLUG}-reverb.conf
[program:${APP_SLUG}-reverb]
command=php ${PROJECT_PATH}/artisan reverb:start
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=${PROJECT_PATH}/storage/logs/reverb.log
EOF

    cat <<EOF > /etc/supervisor/conf.d/${APP_SLUG}-worker.conf
[program:${APP_SLUG}-worker]
command=php ${PROJECT_PATH}/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=${PROJECT_PATH}/storage/logs/worker.log
EOF
fi
run_step_command "Restarting Supervisor processes..." sh -c "supervisorctl reread && supervisorctl update && supervisorctl start all"
finish_step

# 12. Final Optimizations
start_step
run_step_command "Configuring Scheduler & Firewall..." sh -c "echo '* * * * * cd ${PROJECT_PATH} && php artisan schedule:run >> /dev/null 2>&1' | crontab -"
ufw allow 'Nginx Full' >> "$INSTALL_LOG" 2>&1
ufw allow 8080 >> "$INSTALL_LOG" 2>&1
ufw allow 22 >> "$INSTALL_LOG" 2>&1
echo "y" | ufw enable >> "$INSTALL_LOG" 2>&1
php artisan storage:link >> "$INSTALL_LOG" 2>&1 || true
finish_step

# --- Success ---

CURRENT_STEP=$((TOTAL_STEPS + 1))
draw_box_top "INSTALLATION SUCCESSFUL"
print_line "${GREEN}${BOLD}${CHECK} Congratulations! Your ${APP_NAME} VPS is ready.${NC}"
print_line ""
print_line "${BOLD}${GLOBE} Domain:${NC} http://${DOMAIN_NAME}"
print_line "${BOLD}${DATABASE} Database:${NC} ${DB_NAME} (User: ${DB_USER})"
print_line "${BOLD}${GEAR} Node.js:${NC} $(node -v)"
print_line "${BOLD}${GEAR} PHP:${NC} 8.3-FPM"
print_line "Log: ${INSTALL_LOG}"
echo -e "${THEME_COLOR}├──────────────────────────────────────────────────────────────────────────┤${NC}"
print_line "${BOLD}WHAT'S NEXT?${NC}"
print_line "1. Visit http://${DOMAIN_NAME} to finish via GUI."
print_line "2. Or run: ${THEME_COLOR}php artisan web:install${NC} for CLI setup."
print_line "3. Secure your site with: ${THEME_COLOR}sudo certbot --nginx -d ${DOMAIN_NAME}${NC}"
draw_box_bottom

echo ""
echo -e " ${ITALIC}Thank you for using the Premium Auto-Installer!${NC}"
echo ""
