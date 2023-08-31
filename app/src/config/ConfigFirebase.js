import { initializeApp } from "firebase/app";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyBj_8GSdTMvctVQfHdeslfHpqAmy60n0bg",
  authDomain: "fitpro-80ad0.firebaseapp.com",
  projectId: "fitpro-80ad0",
  storageBucket: "fitpro-80ad0.appspot.com",
  messagingSenderId: "505621313166",
  appId: "1:505621313166:web:555ee03debd7dd0abbfbdf"
};

// Initialize Firebase
const firebase = initializeApp(firebaseConfig);

export default firebase;