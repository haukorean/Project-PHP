$(document).ready(function() {

      $('.phoneNumberInput').on('change', function() {
        var phoneNumber = $(this).val();

        // Loại bỏ tất cả các ký tự không phải là số
        phoneNumber = phoneNumber.replace(/\D/g, '');

        // Kiểm tra xem số điện thoại có đủ độ dài hay không
        if (phoneNumber.length <= 10) {
          // Định dạng số điện thoại thành (XXX) XXX-XXXX
          phoneNumber = phoneNumber.replace(/(\d{3})(\d{4})(\d{3})/, '($1) $2-$3');
          $(this).val(phoneNumber);
        }

      });




      $('.PriceInput').on('input', function() {
        var PriceNumber = $(this).val();

        // Loại bỏ tất cả các ký tự không phải là số
        PriceNumber = PriceNumber.replace(/\D/g, '');

        // Kiểm tra xem số điện thoại có đủ độ dài hay không
        if (PriceNumber.length <= 10) {
          // Định dạng số điện thoại thành (XXX) XXX-XXXX
          PriceNumber = PriceNumber.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

          $(this).val(PriceNumber);
        }

      });



 });