
      
const affiliationInput = document.querySelector('#affiliation');
  
const affiliationList = document.querySelector("#universityList");
  
let debounceTimer;
affiliationInput.addEventListener('input', ()=> {
  clearTimeout(debounceTimer);
  debounceTimer = setTimeout(() => {
      fetchAffiliation();
  }, 1000);
  });
  const fetchAffiliation= async()=>{
  await fetch(`https://web-production-cecc.up.railway.app/api/universities/?title=${affiliationInput.value}`)
  .then(response => response.json())
  .then(data => {
      data.forEach(university => {
          const option = document.createElement("option");
          option.textContent = university;
          option.value = university;
          affiliationList.appendChild(option);
      });
  })
  .catch(error => {
      console.error('Error fetching JSON:', error);
  });
}
  
