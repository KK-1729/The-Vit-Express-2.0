var animate = ScrollReveal();

animate.reveal('.display-4', {
    duration: 3000,
    origin: 'left',
    distance: '100px'
});

animate.reveal('.lead', {
    delay: 2000,
    duration: 2000,
    origin: 'left',
    distance: '100px'
});

animate.reveal('.newspic, .tag', {
    delay: 2000
});

animate.reveal('.rumour-heading', {
    delay: 1000,
    distance: '100px',
    origin:'left',
    duration: 2000
});

animate.reveal('.headlines-heading', {
    delay: 1000,
    distance: '100px',
    origin:'right',
    duration: 2000
});

animate.reveal('.card', {
    delay: 2500,
});