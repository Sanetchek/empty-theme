document.addEventListener('DOMContentLoaded', function () {
  const accordionItems = document.querySelectorAll('.accordion-item');
  const accordionTitles = document.querySelectorAll('.accordion-question');

  // ---We check if there is Active when loading ---
  accordionItems.forEach(item => {
    if (item.classList.contains('active')) {
      const ans = item.querySelector('.accordion-answer');
      ans.style.maxHeight = ans.scrollHeight + "px";
    }
  });

  accordionTitles.forEach(title => {
    title.addEventListener('click', function () {
      const container = this.closest('.accordion-item');
      const answer = container.querySelector('.accordion-answer');
      const isOpen = container.classList.contains('active');

      // Close everything
      accordionItems.forEach(item => {
        item.classList.remove('active');
        item.querySelector('.accordion-answer').style.maxHeight = null;
      });

      // Open the selected
      if (!isOpen) {
        container.classList.add('active');
        answer.style.maxHeight = answer.scrollHeight + "px";
      }
    });
  });
});
