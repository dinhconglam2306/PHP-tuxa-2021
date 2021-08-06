
$(document).ready(function() {
    $('.btn-delete').on('click', function(event){
        event.preventDefault();
        var check = confirm('Bạn có chắc chắn muốn xóa item này!')
        if(check){
            window.location.href = $(this).attr('href');
        }
  })
});
