import Swup from 'swup';
import { initCustomScripts } from './script.js';

const swup = new Swup({
	linkSelector: 'a[href]:not([data-no-swup]):not([target="_blank"])',
	containers: ['#swup']
});

// Инициализация при первой загрузке
document.addEventListener('DOMContentLoaded', () => {
	initCustomScripts();
});

// Инициализация после замены контента (SPA переход)
swup.hooks.on('content:replace', () => {
	initCustomScripts();
});
