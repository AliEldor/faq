document.addEventListener('DOMContentLoaded', () => {
    
    const faqCardsContainer = document.querySelector('.faq-cards');

    const searchInput = document.getElementById('faq-search');
    

    const addFaqBtn = document.getElementById('add-faq-btn');
    if (addFaqBtn) {
        addFaqBtn.addEventListener('click', function() {
            window.location.href = '../../../faq/article-client/faq.html';
        });
    }

    
    
    const fetchFaqs = async () => {
      try {
       
        faqCardsContainer.innerHTML = '<p>Loading FAQs...</p>';
        
        
        const response = await axios.get('../../../faq/article-server/apis/v1/getQuestions.php');
        
        
        if (response.data.success) {
          
          faqCardsContainer.innerHTML = '';
          
          
          const questions = response.data.questions;
          
          if (questions.length === 0) {
            faqCardsContainer.innerHTML = '<p>No FAQs found.</p>';
            return;
          }
          
          // Create  FAQ card
          questions.forEach(faq => {
            const faqCard = document.createElement('div');
            faqCard.className = 'faq-card';
            
            faqCard.innerHTML = `
              <h3 class="faq-question">${faq.question}</h3>
              <p class="faq-answer">${faq.answer}</p>
            `;
            
            faqCardsContainer.appendChild(faqCard);
          });
        } else {
          
          faqCardsContainer.innerHTML = `<p>Error: ${response.data.message}</p>`;
        }
      } catch (error) {
        console.error('Error fetching FAQs:', error);
        faqCardsContainer.innerHTML = '<p>Error connecting to server. Please try again later.</p>';
      }
    };
    
    fetchFaqs();

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            filterFAQs(this.value);
        });
    }

    function filterFAQs(searchTerm) {
        const faqCards = document.querySelectorAll('.faq-card');
        const lowerSearchTerm = searchTerm.toLowerCase();
        
        faqCards.forEach(card => {
            const question = card.querySelector('.faq-question').textContent.toLowerCase();
            const answer = card.querySelector('.faq-answer').textContent.toLowerCase();
            
            if (question.includes(lowerSearchTerm) || answer.includes(lowerSearchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    const logoutBtn = document.querySelector('.logout');
    function handleLogout() {
        localStorage.removeItem("user_Id");
        localStorage.removeItem("user_fullname");
        window.location.href = "../index.html";
    }

    if (logoutBtn) {
        logoutBtn.addEventListener('click', handleLogout);
    }

    

  });