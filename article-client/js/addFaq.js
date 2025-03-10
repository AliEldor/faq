document.addEventListener('DOMContentLoaded',()=>{
    document.getElementById('faq-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const question = document.getElementById('question').value.trim();
        const answer = document.getElementById('answer').value.trim();
            
            if (!question || !answer) {
                alert('Please fill in both fields');
                return;
            }

            try {
                
                const formData = new FormData(e.target);
                console.log('Submitting form data:', Object.fromEntries(formData));
                
                const response = await axios.post('../../../faq/article-server/apis/v1/addQuestions.php', formData);
                console.log('Full response:', response);
    console.log('Response data:', response.data);


                if (response.data.success) {
                    alert('FAQ added successfully!');
                    ;setTimeout(() => {
                        window.location.href = '../../../faq/article-client/home.html';
                    }, 500);
                } else {
                    alert('Error: ' + response.data.message);
                }
            
            } catch (error) {
                console.error('Error submitting form:', error);
                console.log('Error details:', error.response ? error.response.data : 'No response data');
                alert('An error occurred. Please try again.');
            }

        });
    });
        
