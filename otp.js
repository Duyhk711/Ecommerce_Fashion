// Cấu hình Firebase
const firebaseConfig = {
  apiKey: "AIzaSyAKJcQ5FML4b9N5vBqEn3qDS7Ox4qoUDNI",
  authDomain: "polyshop-e638c.firebaseapp.com",
  projectId: "polyshop-e638c",
  storageBucket: "polyshop-e638c.appspot.com",
  messagingSenderId: "586602343726",
  appId: "1:586602343726:web:ed370e205e440baa72debf",
  measurementId: "G-11REHLJF8V"
};
// Khởi tạo Firebase
firebase.initializeApp(firebaseConfig);
const auth = firebase.auth();

// Gửi OTP
function sendOtp(phoneNumber) {
  const appVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
      size: 'invisible'
  });

  return auth.signInWithPhoneNumber(phoneNumber, appVerifier)
      .then((confirmationResult) => {
          // OTP đã được gửi đến số điện thoại
          console.log("OTP sent:", confirmationResult);
          return confirmationResult.verificationId; // Trả về Verification ID
      })
      .catch((error) => {
          console.error("Error during sending OTP:", error);
          return { error: error.message };
      });
}

// Xác thực OTP
function verifyOtp(verificationId, otp) {
  const credential = firebase.auth.PhoneAuthProvider.credential(verificationId, otp);
  return auth.signInWithCredential(credential)
      .then((userCredential) => {
          // Xác thực thành công
          console.log("User signed in:", userCredential);
          return userCredential.user; // Trả về thông tin người dùng
      })
      .catch((error) => {
          console.error("Error during verifying OTP:", error);
          return { error: error.message };
      });
}
