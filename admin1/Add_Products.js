document.addEventListener('DOMContentLoaded', function() {
  const input = document.getElementById('image-upload');
  const imageIcon = document.querySelector('.image-icon');
  const imageContainer = document.querySelector('.image-container');
  const imagePreview = document.getElementById('image-preview');
  const uploadText = document.querySelector('.upload-text');
  const productForm = document.getElementById('productForm');
  const errorMessage = document.getElementById('error-message');
  let formSubmitted = false;

  input.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        console.log('Image data loaded successfully:', e.target.result);
        imagePreview.src = e.target.result;
        imageIcon.style.display = 'none';
        imageContainer.style.display = 'block';
        uploadText.style.display = 'none';
      };
      reader.onerror = function(e) {
        console.error('Error reading image file:', e.target.error);
      };
      reader.readAsDataURL(file);
    } else {
      imagePreview.src = '';
      imageIcon.style.display = 'block';
      imageContainer.style.display = 'none';
      uploadText.style.display = 'block';
    }
  });

  productForm.addEventListener('submit', function(event) {
    event.preventDefault();
    formSubmitted = true;

    const validationMessage = validateForm();
    console.log("Validation Message:", validationMessage);

    if (validationMessage === '') {
      productForm.submit();
    } else {
    
       errorMessage.textContent = validationMessage;
       errorMessage.style.color = 'red';
    }
  });

  function validateForm() {
    const productName = document.getElementById('ProductName').value.trim();
    const productDescription = document.getElementById('ProductDescreption').value.trim();
    const productSize = document.getElementById('ProductSize').value;
    const productPrice = document.getElementById('ProductPrice').value.trim();
    const productQty = document.getElementById('ProductQty').value.trim();
    const productCategory = document.getElementById('ProductCategory').value;
    const productImage = document.getElementById('image-upload').value;

    console.log('productName:', productName);
    console.log('productDescription:', productDescription);
    console.log('productSize:', productSize);
    console.log('productPrice:', productPrice);
    console.log('productQty:', productQty);
    console.log('productCategory:', productCategory);
    console.log('productImage:', productImage);

    if (
      productName === '' || productDescription === '' ||
      productSize === '' || productPrice === '' ||
      productQty === '' ||  productCategory === '' ||
      productImage === ''
    ) {
      return 'Please fill out all the missing fields!' ;
    }

    return '';
  }


});
