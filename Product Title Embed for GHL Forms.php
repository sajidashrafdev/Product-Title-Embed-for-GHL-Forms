<script>
(function(){
  var PARAM_KEY = 'product_title';
  var FORM_ID   = '4PxHT6jQ2Ztl4GftkTAw';
  var lastClickedTitle = '';

  function normalizeText(t){ return (t||'').trim().replace(/\s+/g,' '); }

  function getSingleProductTitle(){
    var el = document.querySelector('h1.product_title') || document.querySelector('h1.entry-title');
    return el ? normalizeText(el.textContent) : '';
  }

  function getTitleFromCard(card){
    if (!card) return '';
    var el =
      card.querySelector('.woocommerce-loop-product__title') ||
      card.querySelector('.elementor-heading-title') ||
      card.querySelector('h2 a, h3 a') ||
      card.querySelector('a.woocommerce-LoopProduct-link');
    return el ? normalizeText(el.textContent) : '';
  }

    function resolveTitle(){
    return lastClickedTitle || getSingleProductTitle();
  }

  function setQueryParam(url, key, val){
    try{
      var u = new URL(url, window.location.origin);
      u.searchParams.set(key, val);
      return u.toString();
    }catch(e){
      var sep = url.indexOf('?') === -1 ? '?' : '&';
      return url + sep + key + '=' + encodeURIComponent(val);
    }
  }

  function findFormIframe(){
    return document.querySelector('.elementor-popup-modal iframe[data-form-id="'+FORM_ID+'"]') ||
           document.querySelector('iframe[data-form-id="'+FORM_ID+'"]') ||
           document.querySelector('iframe#inline-'+FORM_ID) ||
           document.querySelector('iframe[src*="/widget/form/'+FORM_ID+'"]');
  }

    function applyTitle(){
    var title = resolveTitle();
    if (!title) return;

    // 1) Put param on the PARENT page URL (no reload)
    var newPageUrl = setQueryParam(window.location.href, PARAM_KEY, title);
    window.history.replaceState({}, '', newPageUrl);

    // 2) Refresh iframe once so embed re-reads parent params
    var iframe = findFormIframe();
    if (iframe && iframe.dataset.refreshedForTitle !== title){
      iframe.dataset.refreshedForTitle = title;
      var src = iframe.getAttribute('src') || iframe.src;
      // force reload same src
      iframe.src = src;
    }

    // clear click title after use
    setTimeout(function(){ lastClickedTitle = ''; }, 1500);
  }

  // capture product clicked in loop/grid
  document.addEventListener('click', function(e){
    var trigger = e.target.closest('a, button');
    if (!trigger) return;

    var card =
      trigger.closest('li.product') ||
      trigger.closest('.product') ||
      trigger.closest('[data-product_id]');

    if (!card) return;

    var t = getTitleFromCard(card);
    if (t) lastClickedTitle = t;
  }, true);

  // detect popup open
  var obs = new MutationObserver(function(){
    if (document.querySelector('.elementor-popup-modal')) {
      [50, 250, 800, 1500].forEach(function(ms){
        setTimeout(applyTitle, ms);
      });
    }
  });
  obs.observe(document.documentElement, {childList:true, subtree:true});

})();
</script>
