document.addEventListener('DOMContentLoaded', fetchData);

async function fetchData() {
  try {
    const response = await fetch('http://127.0.0.1:5000//articles/recommendations', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
          period: "weekly"
      })
    });

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json();

    console.log('API Response:', data);

    const formattedData = data.recommendations.map(item => {
      return `<strong>Title:</strong> ${item.title}<br>
              <strong>Author:</strong> ${item.author}<br>
              <strong>Abstract:</strong> ${item.abstract}<br>
              <strong>Date:</strong> ${item.date}<br>
              <strong>Journal:</strong> ${item.journal}<br>
              <strong>Views:</strong> ${item.total_reads}<br><br>`;
              
    }).join('');

    document.getElementById('apiData').innerHTML = formattedData;
  } catch (error) {
    console.error('Error fetching data:', error);
    document.getElementById('apiData').innerText = 'Error fetching data';
  }
}