# Livriko 🚗

**Application de réservation de courses VTC** — Fork de Taxido personnalisé pour Livriko.

| Component | Stack | Description |
|-----------|-------|-------------|
| **Taxido_laravel/** | Laravel 11 + PHP 8.2 | API REST, Admin panel, Base de données |
| **Taxido_user/** | React Native 0.82 | Application passagers (iOS & Android) |
| **Taxido_driver/** | React Native 0.82 | Application chauffeurs (iOS & Android) |

---

## 🎨 Branding

| Élément | Valeur |
|---------|--------|
| Nom User App | **Livriko** |
| Nom Driver App | **Livriko Driver** |
| Couleur primaire | `#1070b7` (bleu) |
| Couleur secondaire | `#be1823` (rouge) |
| Package User | `com.livriko.user` |
| Package Driver | `com.livriko.driver` |

---

## 🏗️ Architecture

```
livriko.fr/
├── Taxido_laravel/          # Backend API + Admin
│   ├── app/                 # Contrôleurs, Modèles, Services
│   ├── Modules/             # Modules métier (paiements, etc.)
│   ├── config/              # Configuration Laravel
│   ├── database/            # Migrations, Seeders
│   └── public/              # Point d'entrée web
│
├── Taxido_user/             # App Passager (React Native)
│   ├── src/
│   │   ├── screens/         # Écrans de l'application
│   │   ├── components/      # Composants réutilisables
│   │   ├── navigation/      # Navigation (React Navigation)
│   │   ├── api/             # Services API, Store Redux
│   │   ├── themes/          # Thème, Couleurs, Polices
│   │   └── utils/           # Utilitaires
│   ├── android/             # Projet Android natif
│   └── ios/                 # Projet iOS natif
│
├── Taxido_driver/           # App Chauffeur (React Native)
│   ├── src/
│   │   ├── screens/
│   │   ├── commonComponents/
│   │   ├── navigation/
│   │   ├── api/
│   │   └── theme/
│   ├── android/
│   └── ios/
│
├── livriko png 0.5x/        # Assets logo Livriko
└── .github/workflows/       # CI/CD GitHub Actions
```

---

## 🚀 Démarrage Rapide

### 1. Backend Laravel

```bash
cd Taxido_laravel

# Installer les dépendances
composer install

# Configurer l'environnement
cp .env.example .env
# Éditer .env avec vos paramètres (DB, etc.)

# Générer la clé
php artisan key:generate

# Migrations + seeders
php artisan migrate --seed

# Lancer le serveur
php artisan serve
```

### 2. Application Mobile (User)

```bash
cd Taxido_user
npm install

# Lancer sur Android
npm run android

# Lancer sur iOS
cd ios && pod install && cd ..
npm run ios
```

### 3. Application Mobile (Driver)

```bash
cd Taxido_driver
npm install

# Lancer sur Android
npm run android

# Lancer sur iOS
cd ios && pod install && cd ..
npm run ios
```

---

## 🔧 Configuration Mobile

### Changer le nom de l'app
- **Android** : `android/app/src/main/res/values/strings.xml` → `<string name="app_name">`
- **iOS** : `ios/.../Info.plist` → `CFBundleDisplayName`

### Changer les couleurs
- **User App** : `src/themes/appColors.tsx` → variable `primary`
- **Driver App** : `src/theme/appColors.tsx` → variable `primary`

### Changer l'icône
- **Android** : Remplacer les fichiers dans `android/app/src/main/res/mipmap-*/`
- **iOS** : Remplacer les images dans `Images.xcassets/AppIcon.appiconset/`

### Changer l'icône de splash screen
- Remplacer les images dans `src/assets/images/splash/`

---

## 🔐 Variables d'Environnement

### Laravel (.env)
| Variable | Description |
|----------|-------------|
| `APP_NAME` | Nom de l'application |
| `APP_URL` | URL du backend |
| `DB_*` | Configuration base de données |
| `GOOGLE_MAP_API_KEY` | Clé API Google Maps |
| `FIREBASE_*` | Configuration Firebase Cloud Messaging |
| `PUSHER_*` / `REVERB_*` | WebSocket pour live tracking |
| `MAIL_*` | Configuration SMTP |
| `STRIPE_*` | Clés Stripe |

### React Native (.env)
| Variable | Description |
|----------|-------------|
| `API_URL` | URL de l'API Laravel |
| `GOOGLE_MAPS_API_KEY` | Clé API Google Maps |

---

## ☁️ CI/CD (GitHub Actions)

Le pipeline automatise :
- ✅ Tests Laravel (PHPUnit)
- ✅ Lint + TypeScript User App
- ✅ Lint + TypeScript Driver App
- 📦 Build Android APK + AAB (User & Driver)

Déclencheurs : push sur `main`, PR vers `main`, ou workflow_dispatch manuel.

---

## 📦 Générer les Builds de Production

### Android (APK / AAB)
```bash
cd Taxido_user/android
./gradlew assembleRelease   # APK
./gradlew bundleRelease     # AAB
```

### iOS (Archive)
```bash
cd Taxido_user/ios
xcodebuild -workspace TaxidoUserApp.xcworkspace -scheme TaxidoUserApp archive
```

---

## 📄 Licence

Projet privé — Livriko.
