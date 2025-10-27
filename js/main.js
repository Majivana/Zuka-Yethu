document.addEventListener('DOMContentLoaded', function () {
  // Auto-pause hero slider on hover
  const heroCarousel = document.getElementById('heroCarousel');
  if (heroCarousel) {
    heroCarousel.addEventListener('mouseenter', () => {
      const carousel = bootstrap.Carousel.getInstance(heroCarousel);
      carousel?.pause();
    });
    heroCarousel.addEventListener('mouseleave', () => {
      const carousel = bootstrap.Carousel.getInstance(heroCarousel);
      carousel?.cycle();
    });
  }

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });

  // Form submission (mock)
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Thank you! Your message has been sent. We’ll contact you soon.');
      this.reset();
    });
  }
});