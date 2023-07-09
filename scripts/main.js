async function getCities(e){
    let countryid=e.target.value;
    let resp=await fetch(`/pages/getcities.php?id=${countryid}`);
    if(resp.ok){
        let option=await resp.text();
        let hotelcities=document.getElementById("hotelcities");
        hotelcities.innerHTML=option;
    }
}