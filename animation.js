function applyAnimations() {
    const sections = document.querySelectorAll('.container3');
    const images = document.querySelectorAll('.card-img');
    const titles = document.querySelectorAll('h2');
    const subtitles = document.querySelectorAll('.card-title');

    sections.forEach((section, index) => {
        section.setAttribute('data-aos', index % 2 === 0 ? 'fade-up' : 'fade-down');
        section.setAttribute('data-aos-offset', '200');
    });

    images.forEach((image, index) => {
        image.setAttribute('data-aos', 'zoom-in');
        image.setAttribute('data-aos-delay', `${index * 100}`);
    });

    titles.forEach((title) => {
        title.setAttribute('data-aos', 'fade-right');
    });

    subtitles.forEach((subtitle) => {
        subtitle.setAttribute('data-aos', 'fade-up');
    });
}

function initializeAnimations() {
    applyAnimations();

    AOS.init({
        offset: 200,
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        mirror: false,
    });

    window.addEventListener('resize', () => {
        AOS.refresh();
    });
}

document.addEventListener('DOMContentLoaded', initializeAnimations);
