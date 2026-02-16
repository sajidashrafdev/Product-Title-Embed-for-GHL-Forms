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
