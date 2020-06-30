var myHeaders = new Headers();
myHeaders.append("X-M2M-Origin", "017c7e810b75e05b:0932f32db0c81348");
myHeaders.append("Content-Type", "application/json;ty=4");
myHeaders.append("Accept", "application/json");

var requestOptions = {
  method: 'GET',
  headers: myHeaders,
  redirect: 'follow'
};

fetch("https://platform.antares.id:8443/~/antares-cse/antares-id/NewApp/smartHome/la", requestOptions)
  .then(response => response.text())
  .then(result => console.log(result))
  .catch(error => console.log('error', error));