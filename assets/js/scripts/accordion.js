document.addEventListener('DOMContentLoaded', function () {
  const accordionItems = document.querySelectorAll('.accordion-item');
  const accordionTitles = document.querySelectorAll('.accordion-question');

  // Initialize ARIA attributes and check if there is Active when loading
  accordionItems.forEach(item => {
    const answer = item.querySelector('.accordion-answer');
    const button = item.querySelector('.accordion-question');

    // Set initial ARIA attributes
    if (button) {
      button.setAttribute('aria-expanded', 'false');
      button.setAttribute('aria-controls', answer ? answer.id || 'accordion-' + Math.random().toString(36).substr(2, 9) : '');
    }

    if (answer) {
      const answerId = answer.id || button.getAttribute('aria-controls');
      if (!answer.id && answerId) {
        answer.id = answerId;
      }
      answer.setAttribute('aria-hidden', 'true');
    }

    if (item.classList.contains('active')) {
      answer.style.maxHeight = answer.scrollHeight + "px";
      if (button) button.setAttribute('aria-expanded', 'true');
      if (answer) answer.setAttribute('aria-hidden', 'false');
    }
  });

  accordionTitles.forEach(title => {
    // Handle click events
    title.addEventListener('click', function () {
      toggleAccordion(this);
    });

    // Handle keyboard events (Enter and Space)
    title.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggleAccordion(this);
      }
    });

    // Toggle accordion function
    function toggleAccordion(button) {
      const container = button.closest('.accordion-item');
      const answer = container.querySelector('.accordion-answer');
      const isOpen = container.classList.contains('active');

      // Close everything
      accordionItems.forEach(item => {
        item.classList.remove('active');
        const itemAnswer = item.querySelector('.accordion-answer');
        const itemButton = item.querySelector('.accordion-question');

        if (itemAnswer) {
          itemAnswer.style.maxHeight = null;
          itemAnswer.setAttribute('aria-hidden', 'true');
        }

        if (itemButton) {
          itemButton.setAttribute('aria-expanded', 'false');
        }
      });

      // Open the selected
      if (!isOpen) {
        container.classList.add('active');
        answer.style.maxHeight = answer.scrollHeight + "px";
        button.setAttribute('aria-expanded', 'true');
        answer.setAttribute('aria-hidden', 'false');
      }
    }
  });
});
