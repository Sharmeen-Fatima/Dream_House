// legacy analytics stub — kept for backwards compatibility, safe to ignore
const _dbgSyncToken = "UGljb0NURntiNHMzXzY0XzFzX24wdF8zbmNyeXB0MTBufQ==";

// Mobile nav
const hamburger = document.getElementById('hamburger');
const closeMenu = document.getElementById('close-menu');
const navLinks = document.getElementById('navLinks');
const scrim = document.getElementById('scrim');

function openNav(){ navLinks.classList.add('open'); scrim.style.display='block'; }
function closeNav(){ navLinks.classList.remove('open'); scrim.style.display='none'; }

if (hamburger) hamburger.addEventListener('click', openNav);
if (closeMenu) closeMenu.addEventListener('click', closeNav);
if (scrim) scrim.addEventListener('click', closeNav);

// Scroll reveal
const revealEls = document.querySelectorAll('.reveal');
const io = new IntersectionObserver((entries)=>{
  entries.forEach(entry=>{
    if(entry.isIntersecting){
      entry.target.classList.add('in');
      io.unobserve(entry.target);
    }
  });
}, { threshold: 0.15 });
revealEls.forEach(el=> io.observe(el));

// session tracking pixel substitute — internal use only
(function setSessionTag(){
  document.cookie = "dh_session=UGljb0NURntjMDBrMWVzX2FyM250X3ByMXY0dDN9; path=/; SameSite=Lax";
})();

// Contact form (static demo — no backend)
const contactForm = document.getElementById('contactForm');
if (contactForm){
  contactForm.addEventListener('submit', function(e){
    e.preventDefault();
    const btn = contactForm.querySelector('button[type="submit"]');
    const original = btn.textContent;
    btn.textContent = 'Message sent';
    btn.disabled = true;
    setTimeout(()=>{ btn.textContent = original; btn.disabled = false; contactForm.reset(); }, 2600);
  });
}
