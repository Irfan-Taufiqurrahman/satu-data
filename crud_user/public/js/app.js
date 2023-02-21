const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

// function showRole(){
//   const role_0 = document.querySelector('#role_0');
//   const role_1 = document.querySelector('#role_1');
//   const role_2 = document.querySelector('#role_2');
//   const selected =  document.querySelector('#selected');
//   if(selected == role_0){
//     role_1.style.display = 'none';
//     role_2.style.display = 'none';
//   }else if(selected == role_1){
//     role_0.style.display = 'none';
//     role_2.style.display = 'none';
//   }else {
//     role_0.style.display = 'none';
//     role_1.style.display = 'none';
//   }
// }

function previewImage(){
  const image = document.querySelector('#user_photoProfile');
  const imgPreview = document.querySelector('.img-preview');

  imgPreview.style.display = 'block';

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent){
    imgPreview.src = oFREvent.target.result;
  }
}