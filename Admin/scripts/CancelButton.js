
  /******************************Cancel Button**************************************/

  const cancelButton =(buttonId)=>{
    $(document).on("click",buttonId,function() {
      Swal.fire({
          title: 'Are you sure?',
          text: "The data you update will not be saved.",
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
                  `Your data has not been ${window.location.pathname.includes("AddDonor.php")? "added" : "updated"}.`,
                  'error'
              )
              setTimeout(() => {
                  window.location.href = "Donors.php";
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