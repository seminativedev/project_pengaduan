
<script type="text/javascript">
  var loadingSpinner = document.getElementById('loading');
  var closeOffcanvasBtn = document.getElementById('closeOffcanvasBtn');
  function adduserku(argument) {
    var isinya = document.getElementById('Itambah');
    const formData = new FormData($(isinya)[0]);
    $.ajax({
      type: "POST",
      url: "<?=BASEURL,$_GET[0],'/proses/adduser/'?>",
      data: formData,
      enctype: "multipart/form-data",
      processData: false,
      contentType: false,
      beforeSend: function() {
       loadingSpinner.style.display = 'block';
     },
     success: function(hasil) {
      if (hasil.h == true) {
        loadingSpinner.style.display = 'none';
        bersih();
        // closeOffcanvasBtn.click();
        Swal.fire({
          icon: 'success',
          title: 'success',
          text: 'success',
          showConfirmButton: false,
          timer: 1500
        });
      }else{
        loadingSpinner.style.display = 'none';
        Swal.fire({
          icon: 'error',
          title: 'Data Failed',
          text: 'Data Ready in databases.',
          showConfirmButton: false,
          timer: 1500
        });
      }
    },
    error: function() {
      loadingSpinner.style.display = 'none';
          // Error handling in case of AJAX failure
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'An error occurred. Please try again later.',
        showConfirmButton: false,
        timer: 1500
      });
    }, 
  });
  }
  function adddatarw(argument) {
    var formElement = document.getElementById('Itambahrw');
    const formData = new FormData($('#Itambahrw')[0]);
    $.ajax({
      type: "POST",
      url: "<?=BASEURL,$_GET[0],'/proses/addrwrt/'?>",
      data: formData,
      enctype: "multipart/form-data",
      processData: false,
      contentType: false,
      beforeSend: function() {
       loadingSpinner.style.display = 'block';
     },
     success: function(hasil) {
      if (hasil.h == true) {
        loadingSpinner.style.display = 'none';
        var inputElements = formElement.querySelectorAll('input');
        for (var i = 0; i < inputElements.length; i++) {
          inputElements[i].value = '';
        }
        Swal.fire({
          icon: 'success',
          title: 'success',
          text: 'success',
          showConfirmButton: false,
          timer: 1500
        });
      }else{
        loadingSpinner.style.display = 'none';
        Swal.fire({
          icon: 'error',
          title: 'Data Failed',
          text: 'Data Ready in databases.',
          showConfirmButton: false,
          timer: 1500
        });
      }
    },
    error: function() {
      loadingSpinner.style.display = 'none';
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'An error occurred. Please try again later.',
        showConfirmButton: false,
        timer: 1500
      });
    }, 
  });
  }
  function Itambahrwrt(argument) {
    var formElement = document.getElementById('Itambahrwrt');
    const formData = new FormData($('#Itambahrwrt')[0]);
    $.ajax({
      type: "POST",
      url: "<?=BASEURL,$_GET[0],'/proses/Itambahrwrt/'?>",
      data: formData,
      enctype: "multipart/form-data",
      processData: false,
      contentType: false,
      beforeSend: function() {
       loadingSpinner.style.display = 'block';
     },
     success: function(hasil) {
      if (hasil.h == true) {
        loadingSpinner.style.display = 'none';
        var inputElements = formElement.querySelectorAll('input');
        for (var i = 0; i < inputElements.length; i++) {
          inputElements[i].value = '';
        }
        Swal.fire({
          icon: 'success',
          title: 'success',
          text: 'success',
          showConfirmButton: false,
          timer: 1500
        });


      }else{
        loadingSpinner.style.display = 'none';
        Swal.fire({
          icon: 'error',
          title: 'Data Failed',
          text: 'Data Ready in databases.',
          showConfirmButton: false,
          timer: 1500
        });
      }
    },
    error: function() {
      loadingSpinner.style.display = 'none';
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'An error occurred. Please try again later.',
        showConfirmButton: false,
        timer: 1500
      });
    }, 
  });
  }  
  function hapuscuy(dari) {
   const idkucuyValue = dari.getAttribute('idkucuy'),formData = new FormData();formData.append('idkucuy', idkucuyValue);
   Swal.fire({title: 'Are you sure?',text: "You won't be able to revert this!",icon: 'warning',showCancelButton: true,
    confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'}).then((result) =>{
      if (result.isConfirmed){
        $.ajax({ type: "POST",url: "<?=BASEURL,$_GET[0],'/proses/hapusCuy/'?>",data:formData,enctype: "multipart/form-data",processData: false,contentType: false,beforeSend: function(){ loadingSpinner.style.display = 'block'; },
         success: function(hasil) {
          if (hasil.h == true){
            loadingSpinner.style.display = 'none';
            Swal.fire({icon: 'success',title: 'success',text: 'success',showConfirmButton: false,timer: 1500})}else{
              Swal.fire({icon: 'error',title: 'Error',text: 'Error',showConfirmButton: false,timer: 1500});loadingSpinner.style.display = 'none';}},
              error: function(){loadingSpinner.style.display = 'none';Swal.fire({icon: 'error', title: 'Error',text: 'An error occurred. Please try again later.',showConfirmButton: false,timer: 1500});}, 
            });
      }});    
  }
  function hapuscuykat(dari) {
   const idkucuyValue = dari.getAttribute('idkucuy'),formData = new FormData();formData.append('idkucuy', idkucuyValue);
   Swal.fire({title: 'Are you sure?',text: "You won't be able to revert this!",icon: 'warning',showCancelButton: true,
    confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'}).then((result) =>{
      if (result.isConfirmed){
        $.ajax({ type: "POST",url: "<?=BASEURL,$_GET[0],'/proses/hapuscuykat/'?>",data:formData,enctype: "multipart/form-data",processData: false,contentType: false,beforeSend: function(){ loadingSpinner.style.display = 'block'; },
         success: function(hasil) {
          if (hasil.h == true){
            loadingSpinner.style.display = 'none';
            Swal.fire({icon: 'success',title: 'success',text: 'success',showConfirmButton: false,timer: 1500})}else{
              Swal.fire({icon: 'error',title: 'Error',text: 'Error',showConfirmButton: false,timer: 1500});loadingSpinner.style.display = 'none';}},
              error: function(){loadingSpinner.style.display = 'none';Swal.fire({icon: 'error', title: 'Error',text: 'An error occurred. Please try again later.',showConfirmButton: false,timer: 1500});}, 
            });
      }});    
  }
  function hapuscuyrw(dari) {
   const idkucuyValue = dari.getAttribute('idkucuy'),formData = new FormData();formData.append('idkucuy', idkucuyValue);
   Swal.fire({title: 'Are you sure?',text: "You won't be able to revert this!",icon: 'warning',showCancelButton: true,
    confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'}).then((result) =>{
      if (result.isConfirmed){
        $.ajax({ type: "POST",url: "<?=BASEURL,$_GET[0],'/proses/hapuscuyrw/'?>",data:formData,enctype: "multipart/form-data",processData: false,contentType: false,beforeSend: function(){ loadingSpinner.style.display = 'block'; },
         success: function(hasil) {
          if (hasil.h == true){
            loadingSpinner.style.display = 'none';
            Swal.fire({icon: 'success',title: 'success',text: 'success',showConfirmButton: false,timer: 1500})}else{
              Swal.fire({icon: 'error',title: 'Error',text: 'Error',showConfirmButton: false,timer: 1500});loadingSpinner.style.display = 'none';}},
              error: function(){loadingSpinner.style.display = 'none';Swal.fire({icon: 'error', title: 'Error',text: 'An error occurred. Please try again later.',showConfirmButton: false,timer: 1500});}, 
            });
      }});    
  }
  function getpesan(argument) {
    if (intervalID) {
      clearInterval(intervalID);
    }
    var xhr = new XMLHttpRequest();
    var idkucuy = argument.getAttribute('idkucuy');
    var namakucuy = argument.getAttribute('namakucuy');
    var pesanElement = document.getElementById('pesankucuy');
    var url = '<?=BASEURL,$_GET[0],'/',$_GET[1],'/pesan/'?>'+idkucuy;
    xhr.open('GET', url, true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        loadingSpinner.style.display = 'none';
        var response = xhr.responseText;
        pesanElement.innerHTML = response;
        intervalID = setInterval(function() {
          callRealtimeFunction(namakucuy);
        }, 1000);
        // clearInterval(realtimeInterval);
      }else{
        loadingSpinner.style.display = 'none';
        pesanElement.innerHTML = 'Gagal memuat pesan';
      }
    };
    xhr.onerror = function() {
      loadingSpinner.style.display = 'none';
      pesanElement.innerHTML = 'Terjadi kesalahan saat memuat pesan';
    };
    loadingSpinner.style.display = 'block';
    xhr.send();
  }
  function pilihpesan(argument) {
    var pesanElement = document.getElementById('tesisipesan');    
    $.ajax({
      type: "POST",
      url: "<?=BASEURL,$_GET[0],'/proses/getpesan/'?>",
      // enctype: "multipart/form-data",
      // processData: false,
      // contentType: false,
      beforeSend: function() {
       loadingSpinner.style.display = 'block';
     },
     success: function(hasil) {
      loadingSpinner.style.display = 'none';
      $(pesanElement).html(hasil.h);
    },
    error: function() {
      loadingSpinner.style.display = 'none';
    }, 
  });
  }
  function pilih_role(dari) {
    var xhr = new XMLHttpRequest();
    const selectedValue = dari.value;
    const pesanElement = document.getElementById('pilihanku');
    var url = '<?=BASEURL,$_GET[0],'/proses/getROLE/'?>' + encodeURIComponent(selectedValue);
    xhr.open('GET', url, true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        loadingSpinner.style.display = 'none';
        var response = xhr.responseText;
        pesanElement.innerHTML = response;
      }else{
        loadingSpinner.style.display = 'none';
        pesanElement.innerHTML = 'Gagal memuat pesan';
      }
    };
    xhr.onerror = function() {
      loadingSpinner.style.display = 'none';
      pesanElement.innerHTML = 'Terjadi kesalahan saat memuat pesan';
    };
    loadingSpinner.style.display = 'block';
    xhr.send();
  }
  function getRT(dari) {
    var selectedRw = dari.value;
    const formData = new FormData();
    formData.append('rw', selectedRw);    
    $.ajax({
      type: "POST",
      url: "<?=BASEURL,$_GET[0],'/proses/getRT'?>",
      data: formData,
      processData: false,
      contentType: false,
      beforeSend:function(){
        loadingSpinner.style.display = 'block';
      },
      success: function(response) {
        if (response.h === true) {
          $('#rtkucuy').html(response.i);
        }else{
          $('#rtkucuy').html(response.i);
          console.error('Gagal mendapatkan data RT.');
        }
        loadingSpinner.style.display = 'none';
      }, 
      error: function(xhr, status, error) {
        loadingSpinner.style.display = 'none';
        console.error('Terjadi kesalahan dalam permintaan AJAX:', error);
      }
    });
  }
  function bersih(argument) {
    // const tombolku = document.getElementById('tombolku');
    // tombolku.setAttribute('onclick', 'addsiswa(this)');
    var formElement = document.getElementById('Itambah');
    var inputElements = formElement.querySelectorAll('input');
    for (var i = 0; i < inputElements.length; i++) {
      inputElements[i].value = '';
    }
    var selectElements = document.querySelectorAll('[bersih="itu"]');
    selectElements.forEach(function(selectElement) {
      selectElement.selectedIndex = 0;
      selectElement.value = ''; 
    });
  }
  function edit(dari){
    const formData = new FormData($('#editkucy')[0]);
    const inputElements = document.querySelectorAll('#editkucy input[type="text"]');
    var selectElements = document.querySelectorAll('[bersih="itu"]');
    const buttonContainer = document.getElementById('buttonContainer');
    const newButton = document.createElement('button');
    $.ajax({
      type: "POST",
      url: "<?=BASEURL,$_GET[0],'/proses/getRW'?>",
      data: formData,
      processData: false,
      contentType: false,
      beforeSend:function(){
        loadingSpinner.style.display = 'block';
      },
      success: function(response) {
        if (response.h === true) {
          $('#rw').html(response.html);
          buttonContainer.removeChild(dari);
          newButton.classList.add('btn', 'btn-success', 'btn-sm', 'ms-1');
          newButton.textContent = 'Simpan';
          newButton.onclick = function() {
            update(this);
          };
          inputElements.forEach((inputElement) => {
            inputElement.removeAttribute('readonly');
            inputElement.removeAttribute('style');
          });
          selectElements.forEach(function(selectElement) {
            selectElement.selectedIndex = 0;
            selectElement.removeAttribute('style');
          });
          buttonContainer.appendChild(newButton);
        }else{
          $('#rw').html(response.html);
          buttonContainer.removeChild(dari);
          newButton.classList.add('btn', 'btn-success', 'btn-sm', 'ms-1');
          newButton.textContent = 'Simpan';
          newButton.onclick = function() {
            update(this);
          };
          inputElements.forEach((inputElement) => {
            inputElement.removeAttribute('readonly');
            inputElement.removeAttribute('style');
          });
          selectElements.forEach(function(selectElement) {
            selectElement.selectedIndex = 0;
            selectElement.removeAttribute('style');
          });
          buttonContainer.appendChild(newButton);
        }
        loadingSpinner.style.display = 'none';
      }, 
      error: function(xhr, status, error) {
        loadingSpinner.style.display = 'none';
        console.error('Terjadi kesalahan dalam permintaan AJAX:', error);
      }
    });
  }
  function edtrwgetdata(dari) {
    const modalcuy = new bootstrap.Modal(document.getElementById('modalrwrtku'));
    const rw = document.getElementById('rw'),rt = document.getElementById('rt');
    const idkucuyValue = dari.getAttribute('idkucuy');
    $.ajax({
      type:'POST',
      url:'<?=BASEURL,$_GET[0]?>/proses/edtrwgetdata/'+idkucuyValue,
      beforeSend:function() {
        loadingSpinner.style.display = 'block';
      },success:function(hasil){
        if (hasil.h === true) {
          modalcuy.show();modalcuy.show();
          rw.value =hasil.rw;
          rt.value =hasil.rt;
        }else{

        }
        loadingSpinner.style.display = 'none';

      },error:function(){
        loadingSpinner.style.display = 'none';
      },
    }) 
  }
  function edtrupdaterwrt(argument) {
    // body...
  }

  function update(dari) {
    const formData = new FormData($('#editkucy')[0]);
    const inputElements = document.querySelectorAll('#editkucy input[type="text"]');
    const selectElements = document.querySelectorAll('#editkucy select');
    const buttonContainer = document.getElementById('buttonContainer');
    const newButton = document.createElement('button');
    // function function_name(dari) {

    //   buttonContainer.removeChild(dari);
    //   newButton.classList.add('btn', 'btn-warning', 'btn-sm', 'ms-1');
    //   newButton.textContent = 'dwdw';
    //   newButton.onclick = function() {
    //     edit(this);
    //   };
    //   inputElements.forEach((inputElement) => {
    //     inputElement.setAttribute('readonly', false);
    //     inputElement.style.backgroundColor = 'white';
    //     inputElement.style.cursor = 'no-drop';
    //   });
    //   selectElements.forEach(function(selectElement) {
    //     selectElement.selectedIndex = 0;
    //     selectElement.style.backgroundColor = 'white';
    //     selectElement.style.cursor = 'no-drop';
    //   });
    //   buttonContainer.appendChild(newButton);
    // }

    
    Swal.fire({title: 'Are you sure?',text: "You won't be able to revert this!",icon: 'warning',showCancelButton: true,
      confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Update!'}).then((result) =>{
        if (result.isConfirmed){
          $.ajax({
            type: "POST",
            url: "<?=BASEURL,$_GET[0],'/proses/update'?>",
            data: formData,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            beforeSend:function(){
              loadingSpinner.style.display = 'block';
            },
            success: function(response) {
              if (response.cek === 'rt'){
                if (response.h === true) {
                 buttonContainer.removeChild(dari);
                 newButton.classList.add('btn', 'btn-warning', 'btn-sm', 'ms-1');
                 newButton.textContent = 'Settings';
                 newButton.onclick = function() {
                  edit(this);
                };
                inputElements.forEach((inputElement) => {
                  inputElement.setAttribute('readonly', false);
                  inputElement.style.backgroundColor = 'white';
                  inputElement.style.cursor = 'no-drop';
                });
                buttonContainer.appendChild(newButton);
                $('#rw').html(response.rw);
                $('#rtkucuy').html(response.rt);
                $('#nama').html(response.nama);
                $('#namas').html(response.nama);
                $('#jabatan').html(response.jabatan);
                Swal.fire({icon: 'success',title: 'success',text: 'success',showConfirmButton: false,timer: 1500})
              }else{
                Swal.fire({icon: 'error',title: 'error',text: 'error',showConfirmButton: false,timer: 1500})
              }              
            }else if (response.cek === 'rw'){
              if (response.h === true) {
               buttonContainer.removeChild(dari);
               newButton.classList.add('btn', 'btn-warning', 'btn-sm', 'ms-1');
               newButton.textContent = 'Settings';
               newButton.onclick = function() {
                edit(this);
              };
              inputElements.forEach((inputElement) => {
                inputElement.setAttribute('readonly', false);
                inputElement.style.backgroundColor = 'white';
                inputElement.style.cursor = 'no-drop';
              });
              buttonContainer.appendChild(newButton);
              $('#rw').html(response.rw);
              $('#rws').html(response.rws);
              $('#nama').html(response.nama);
              $('#namas').html(response.nama);
              $('#jabatan').html(response.jabatan);
              Swal.fire({icon: 'success',title: 'success',text: 'success',showConfirmButton: false,timer: 1500})
            }else{
              Swal.fire({icon: 'error',title: 'error',text: 'error',showConfirmButton: false,timer: 1500})
            }
          }else{
            console.error('Gagal');
          }
          loadingSpinner.style.display = 'none';
        }, 
        error: function(xhr, status, error) {
          loadingSpinner.style.display = 'none';
          console.error('Terjadi kesalahan dalam permintaan AJAX:', error);
        }
      });
        }}); 
    }
    function addkategori(argument) {
      console.log()
    }
    function kirimrespon(dari){
      var chatBox = document.getElementById('tesrealtime');
      const formData = new FormData($('#isiresponku')[0]);
      var id = getIdFromLink(event.target);
      const uciku = document.getElementById('ucisayang');
      $.ajax({
        type: "POST",
        url: "<?=BASEURL,$_GET[0],'/proses/kirimrespon/'?>",
        data: formData,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        beforeSend: function() {
          loadingSpinner.style.display = 'block';
        },
        success: function(hasil){
          if (hasil.h === true) {
            realtimeku(BASEURL + pageParam1 + '/' + pageParam2 + '/realtimepesan/' + hasil.idkucuy, function (content) {
              document.getElementById('tesrealtime').innerHTML = content;
            });
            uciku.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;

          }else{
            console.error('gagal');
          }
          loadingSpinner.style.display = 'none';
        },
        error: function() {
          loadingSpinner.style.display = 'none';
        }, 
      });
    }
    function callRealtimeFunction(namakucuy) {
      var ambe = document.getElementById('idkucuy');
      var idkucuy = ambe.value;
      realtimeku(BASEURL + pageParam1 + '/' + pageParam2 + '/realtimepesan/' + idkucuy+ '/' +namakucuy, function (content) {
        document.getElementById('tesrealtime').innerHTML = content;
      });
    }
    function realtimeku(url, callback) {
      $.ajax({
        type: "GET",
        url: url,
        beforeSend: function() {
          // console.log(url);
        },
        success: function(hasil){
          if (hasil.h === true) {
            callback(hasil.ambil);
          }else{
            console.error('GAGAl');         
          }
        },
        error: function() {
          console.error('INI EROR');          
        }, 
      });
    }
  </script>

