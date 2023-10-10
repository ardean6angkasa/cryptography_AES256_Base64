const flashdata=$('.flashdata').data('flashdata');
const flashdata2=$('.flashdata2').data('flashdata2');
if(flashdata){
    Swal.fire({
        icon: 'info',
        title: '',
        text: flashdata,
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          }
    })
}else if(flashdata2){
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
  Toast.fire({
    icon: 'success',
    title: flashdata2
  })
}