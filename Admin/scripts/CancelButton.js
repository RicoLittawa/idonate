
  /******************************Cancel Button**************************************/

  const cancelButton =(buttonId)=>{
    $(document).on("click",buttonId,function() {
      Swal.fire({
          title: 'Are you sure?',
          text: "The previous actions cannot be saved.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#20d070',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes',
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
              Swal.fire(
                  'Canceled!',
                  `Your data has not been saved.`,
                  'error'
              )
              setTimeout(() => {
                window.history.go(-1)
              }, 1500)
          }
      })
  })
  }
  cancelButton("#cancelBtn");
 
const goBack =(buttonId)=>{
    $(document).on("click",buttonId,()=>{
        window.history.go(-1)
    })
}
goBack("#goBack");