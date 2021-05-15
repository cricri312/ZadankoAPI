// fetch('https://ancient-everglades-30844.herokuapp.com/api/getAll')
//   .then(response => response.json())
//   .then(data => console.log(data[0].panelQuantity));

async function postData(url = '', data = {}) {

    const response = await fetch(url, {
      method: 'POST', 
      mode: 'cors', 
      cache: 'no-cache', 
      credentials: 'same-origin', 
      headers: {
        'Content-Type': 'application/json'
      },
      redirect: 'follow', 
      referrerPolicy: 'no-referrer', 
      body: JSON.stringify(data) 
    });
    return response.json(); 
  }
  let width= document.getElementById("width");
  const form = document.getElementById( "panelAndPaleForm" );
  form.addEventListener("submit",function(event){
      event.preventDefault();
      if(width.value==0) alert("0 value");
      else{
      postData('https://ancient-everglades-30844.herokuapp.com/api/calcPanelsAndPales', { width: width.value })
      .then(data =>{
          
          try {
            if("original" in data.state) {
                document.getElementById('panelQuantity').innerHTML = `panelQuantity: ${data.panelQuantity}`;
                document.getElementById('paleQuantity').innerHTML = `paleQuantity: ${data.paleQuantity}`;
                document.getElementById('msg').innerHTML = ` message: ${data.state.original}`;
              } 
          } catch (error) {
            document.getElementById('panelQuantity').innerHTML = ``;
            document.getElementById('paleQuantity').innerHTML = ``;
            document.getElementById('msg').innerHTML = ` message: ${data.message}`;
          }
          
      });}
  });

  






         

         
        
    //     
    //     form.addEventListener( "submit", function ( event ) {
    //       event.preventDefault();
    //       sendData();
    //     } );
    //   } );