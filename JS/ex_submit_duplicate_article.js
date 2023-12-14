document.getElementById('check-duplication').addEventListener('click', function() {

    const title = document.getElementById('title').value;
    const abstract = document.getElementById('abstract').value;
    const labelTitle = document.getElementById('label-title');
    const labelDuplication = document.getElementById('result-duplication');
    const labelResult = document.getElementById('label-result');
    const journalType = document.getElementById('journal-type');
    const nextBtn = document.getElementById('next');
    const similarTitle = document.getElementById('similar-title');
    const similarAbstract = document.getElementById('similar-abstract');

    

    
    
    

    fetch('https://web-production-cecc.up.railway.app/article/checker', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            title: title,
            abstract: abstract,
        }),
    })
    .then(response => {
        if (!response.ok) {
            labelTitle.style.display = 'none';
            labelAbstract.style.display = 'none';
            journalType.style.display = 'none';
      
            throw new Error('Network response was not ok');
        }
      
        return response.json();

      
    })
    .then(data => {
        if (data.similar_articles.length > 0) {
            document.getElementById('similar-title').innerHTML = data.similar_articles[0].title;
            // document.getElementById('similar-abstract').innerHTML = data.similar_articles[0].abstract;
            document.getElementById('result-duplication').innerHTML = (data.similar_articles[0].score.total * 100).toFixed(2) + '%';
            if(data.highest_simlarity >= 1.0){

                Swal.fire({
                    title: "Duplication Alert!",
                    icon: "info",
                    text: "Revise your Title and Abstract",
                    showConfirmButton: true
                });
    
                journalType.style.display = 'block';
                labelTitle.style.textAlign = 'left';
                labelResult.style.textAlign = 'left';
                labelDuplication.style.textAlign = 'left';
                similarAbstract.style.textAlign = 'left';
              
              
                
                nextBtn.disabled = true;
    
            }else if(data.highest_simlarity >= 0.5 && data.highest_simlarity < 1.0){
                
                Swal.fire({
                    title: "Duplication Alert!",
                    icon: "info",
                    text: "Revise your title or Abstract",
                    showConfirmButton: true
                });
    
                journalType.style.display = 'block';
                labelTitle.style.textAlign = 'left';
                labelResult.style.textAlign = 'left';
                labelDuplication.style.textAlign = 'left';
                similarAbstract.style.textAlign = 'left';
              
                
                nextBtn.disabled = true;
    
             
            }else if(data.highest_simlarity <= 0.4){
                
                Swal.fire({
                    title: "Good Article",
                    icon: "info",
                    text: "You may proceed to the next step",
                    showConfirmButton: true
                });
    
                journalType.style.display = 'block';
                labelTitle.style.textAlign = 'left';
                labelResult.style.textAlign = 'left';
                labelDuplication.style.textAlign = 'left';
                similarAbstract.style.textAlign = 'left';
              
                
                nextBtn.disabled = true;
    
             
            }
        }else{
            if(data.similar_articles.length === 0){
                Swal.fire({
                    title: "Unique Article",
                    icon: "success",
                    text: "You can now proceed to the next step",
                    showConfirmButton: true
                });
    
                journalType.style.display = 'block';
                labelTitle.style.textAlign = 'left';
                labelResult.style.textAlign = 'left';
                labelDuplication.style.textAlign = 'left';
                similarAbstract.style.textAlign = 'left';
              
              
                
            
    
                nextBtn.disabled= false;
    
            }
        }
      
      

      
        
      

      
       
    })

  

    .catch(error => console.error('Error:', error));
});


