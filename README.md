# FitFusion

An Open-Source Gym App for all your needs!

### Don't forget to :star: the repo

[![GitHub stars](https://img.shields.io/github/stars/CodeRealm-HQ/Gym-App.svg?style=social&label=Star)](https://github.com//CodeRealm-HQ/Gym-App) ![GitHub forks](https://img.shields.io/github/forks/CodeRealm-HQ/Gym-App.svg?style=social&label=Forks) ![GitHub followers](https://img.shields.io/github/followers/zerexly.svg?style=social&label=Follow)


### What is Expo.io?
Expo is a free and complete workflow for creating next-generation apps for iOS and Android.
Expo enables you to build cross-platform native apps using only JavaScript. Use your favorite text editor to write powerful React Native components without ever opening Xcode or Android Studio.
In addition to React Native components, you'll have access to the Expo SDK, a library that provides a wide variety of native APIs on iOS and Android. Expo can also manage your assets for you, take care of push notifications, and build your final native binary for submission to the app store.

[​Read more about the Expo SDK​](https://expo.io/)

### System Requirements
- Node.js. Download Here​
- Yarn. Download Here​
- FireBase Account. Create Here
- React Native CLI. Install using **npm install -g react-native-cli**
- Expo CLI. Install using **npm install -g expo-cli**

### Setting up the Backend

1. Unzip package folder then copy backend folder and paste it in your root folder of your server.
2. Open your **phpMyadmin** and go to your current database, choose import tab and select the **database.sql** file you want to import and click on submit.
3. Edit **admin/config.php** file then change followings:

```js
/* URL PROJECT */

define ('SITE_URL', 'YOUR_URL_HERE');

/* DATABASE CONFIGURATION */

$database = array(
'host' => 'DATABASE_HOST_HERE',
'db' => 'DATABASE_NAME_HERE',
'user' => 'DATABASE_USER_HERE',
'pass' => 'DATABASE_PASSWORD_HERE'
);
```
4. Now you can login from your url project with login credentials are:
- **Username**: admin@admin.com
- **Password**: 123456

### Setting up the App
1. Edit **src/config/ConfigApp.js** file then change followings:
   ```js
   
    URL: "https://sahilarun.com/demo/fitfusion/",
    DEFAULTLANG: "en",
    THEMEMODE: "dark", // light or dark
   ```
2. Edit **src/config/ConfigFirebase.js**
```js
/* firebase */
const firebaseConfig = {
  apiKey: "REPLACE_HERE",
  authDomain: "REPLACE_HERE",
  projectId: "REPLACE_HERE",
  storageBucket: "REPLACE_HERE",
  messagingSenderId: "REPLACE_HERE",
  appId: "REPLACE_HERE"
};
```
3. Open **https://console.firebase.google.com/project/${your-acc-name}/settings/serviceaccounts/adminsdk** and select the project you want to generate a **private key file** for.
4. Click Generate New Private Key, then confirm by clicking Generate Key and store it as **google-service-account.json**
5. Go to **./classes/firebase** and replace it
6. From the terminal select the **app** folder.
7. Run **yarn install** and wait for all packages to be installed.
8. Your project is ready, to get started, run **npx expo start -c**

### Customization
1. Change main color
- Open **src/config/ColorsApp.js** and update this value.
```js
const ColorsApp = {
    PRIMARY: "#2472d4",
    SECOND: "#2472d4",
    TERTIARY: "#3c3c3c",

};
```
2. Change the app name
- Open **app.json** and replace this value:
```js
{
  "expo": {
    "name": "Your App Name"
}
```
3. Change Strings
- Open **src/languages/en.json** and replace these values:
```js
{
    "ST1": "BasicFit",
    "ST2": "Home",
    "ST3": "Search",
    "ST4": "Favorites",
    ....
```
4. Change app icon and splash screen
- You just have to replace the images located in the assets folder.

### Build Standalone App
Please follow this document for detail clarify how to build the standalone app and submit to App Store and Google Play: https://docs.expo.io/versions/latest/distribution/building-standalone-apps/

Open the **App.json** and add config for package id:
```js
"ios": {
  "bundleIdentifier": "com.yourcompany.appname"
},
"android": {
  "package": "com.yourcompany.appname"
}
```

## Screenshots

<img src="https://cdn.discordapp.com/attachments/1146753808823758969/1146773599127097436/Screenshot_599.png?raw=true" width="32%"> <img src="https://cdn.discordapp.com/attachments/1146753808823758969/1146773599441662032/Screenshot_600.png?raw=true" width="32%"> <img src="https://cdn.discordapp.com/attachments/1146753808823758969/1146773599697522779/Screenshot_601.png?raw=true" width="32%"> <img src="https://cdn.discordapp.com/attachments/1146753808823758969/1146773599965945886/Screenshot_602.png?raw=true" width="32%"> <img src="https://cdn.discordapp.com/attachments/1146753808823758969/1146773600213413968/Screenshot_603.png?raw=true" width="32%">

### Copyright & Credits
Resources Used

- React Native
- Expo.io
- CKEditor 
- Firebase​
