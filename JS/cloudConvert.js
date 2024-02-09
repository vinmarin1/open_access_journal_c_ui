async function handleDownloadLog(articleId,type) {
    await fetch(
      "https://web-production-cecc.up.railway.app/api/articles/logs",
      {
        method: "POST",
        body: JSON.stringify({
          type: type,
          author_id: sessionId,
          article_id: parseInt(articleId),
        }),
        headers: {
          "Content-Type": "application/json",
        },
      }
    );
}
  
function createCloudConvertJob(file, format) {
    const apiKey =
      "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmQ1NTQ0ZmYwYzE2NTdmNjZhOGExZmQ5YmQ3YjIzODU0YmRiMDhjYjYxNGM1MzE2N2E0NWZmNmJhYzkxYjA2ZGRhYWQ5ZjBiZWFhZmIwOWIiLCJpYXQiOjE3MDEyNDI1MzYuNDg0NDY3LCJuYmYiOjE3MDEyNDI1MzYuNDg0NDY5LCJleHAiOjQ4NTY5MTYxMzYuNDc5ODk1LCJzdWIiOiI2NjI5Njk0NCIsInNjb3BlcyI6WyJ1c2VyLnJlYWQiLCJ1c2VyLndyaXRlIiwidGFzay5yZWFkIiwidGFzay53cml0ZSIsInByZXNldC5yZWFkIiwicHJlc2V0LndyaXRlIiwid2ViaG9vay5yZWFkIiwid2ViaG9vay53cml0ZSJdfQ.BoMmx1_yaPK38lstapuVDFcp474cbqOhwVDIikM7a8H1e8R0I1isn4UZYiON6OGG0ckBSEm-mJbQ0wNaAHjfcpG378098a6uw2YfyJVVgkZP9lr5k2gOCCJXRq3eP5trwXAr9kdkxGZrfn7d9SWr9xF_wFGgd3x5nLjZuLlmjYDAOPx62BVLaDUSQkOg77CeyXFQIR91GuhwdanJF19ASGbWLGypZ1n4RtwIwfChRyNBbOSFo0RsKYzZzaF2v0QyfBGtmRmQJWB6GyC-VXl_DEdld5WnOCt5xPkreE9XKUthI0WgpbId98yCEcx3ZF4T7hRDylLrXJi_c_F-xz85s8MfPpx9_27X1xF7e4cMqUkeeQTANh4fzMSibSx8vZV6sC5Py3fsfj_gQ2D3gG-UqEo2srHS5xhetCW39TqRtgThvwpICHoRV-Q3GZx73BUqgLz0-HlEp7-ZuLZKoJIq6-2HnYZeWtAPuX08dvwWWoCR5E8NvMlZ3vBby8YHuN7pMYpm_LOuebgUyJW-5Ok9yfKy_4wNyq_yadYktpZlfPQ2-QrRucQ6gbkMxyKswqBgwt5D3NL6wWPLu2hnCkprg1SqC459xY4LcPWSRZDUf_S9nqlHbIOrS7vkTYRtkeA81ZpbrkI_v9NU6LjDZfd2k_G13WywEiIUo_wi9cPlpxs";
  
    const apiUrl = "https://api.cloudconvert.com/v2/jobs";
  
    const jsonData = {
      tasks: {
        "import-1": {
          operation: "import/url",
          url: `https://qcuj.online/Files/final-file/${file}`,
          filename: file,
        },
        "task-1": {
          operation: "convert",
          input_format: "docx",
          output_format: format,
          engine: "calibre",
          input: ["import-1"],
        },
        "export-1": {
          operation: "export/url",
          input: ["task-1"],
          inline: true,
          archive_multiple_files: true,
        },
      },
      tag: "jobbuilder",
    };
  
    fetch(apiUrl, {
      method: "POST",
      body: JSON.stringify(jsonData),
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${apiKey}`,
      },
    })
      .then((response) => response.json())
      .then((data) => {
        const downloadUrl = `https://sync.api.cloudconvert.com/v2/jobs/${data.data.id}?redirect=true`;
  
        fetch(downloadUrl, {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${apiKey}`,
          },
        })
          .then((response) => {
            response.blob().then((blob) => {
              console.log(window.URL.createObjectURL(blob));
              const url = window.URL.createObjectURL(blob);
  
              const link = document.createElement("a");
              link.href = url;
              link.download = `${file}.${format}`;
              document.body.appendChild(link);
              link.click();
              document.body.removeChild(link);
            });
          })
          .catch((error) => {
            console.error("Error fetching file content:", error);
          });
      })
      .catch((error) => {
        console.error("Error creating job:", error);
      });
  }
  
  async function handleDownloadLog(articleId,type) {
    await fetch(
      "https://web-production-cecc.up.railway.app/api/articles/logs",
      {
        method: "POST",
        body: JSON.stringify({
          type: type,
          author_id: sessionId,
          article_id: parseInt(articleId),
        }),
        headers: {
          "Content-Type": "application/json",
        },
      }
    );
  }