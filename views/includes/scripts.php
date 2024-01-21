 <!-- Vendor JS Files -->
 <script src="./../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="./../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="./../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="./../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="./../assets/js/main.js"></script>
  <script>
      document.addEventListener("DOMContentLoaded", function () {
          // Get the span element with the class "typed"
          const typedElement = document.querySelector('.typed');
          
          // Get the data-typed-items attribute value and split it into an array
          const typedItems = typedElement.getAttribute('data-typed-items').split(',');

          // Initialize variables
          let currentItem = 0;
          let currentText = '';
          let isDeleting = false;

          // Function to simulate typing
          function type() {
              // Get the current item from the array
              const item = typedItems[currentItem];

              // Check if the text is being typed or deleted
              if (isDeleting) {
                  // Remove a character from the current text
                  currentText = item.substring(0, currentText.length - 1);
              } else {
                  // Add a character to the current text
                  currentText = item.substring(0, currentText.length + 1);
              }

              // Update the span element's text content
              typedElement.innerHTML = `<span class="typed-text">${currentText}</span>`;

              // Set the typing speed (adjust the milliseconds as needed)
              const typingSpeed = 200;

              // Check if a word has been completely typed or deleted
              if ((!isDeleting && currentText === item) || (isDeleting && currentText === '')) {
                  // Toggle the deleting state
                  isDeleting = !isDeleting;

                  // Move to the next item
                  currentItem = (currentItem + 1) % typedItems.length;
              }

              // Continue typing or deleting
              setTimeout(() => {
                  type();
              }, typingSpeed);
          }

          // Start the typing animation
          type();
      });
  </script>