dragula([document.querySelector('.packets')], {
   moves: (el, source, handle, sibling) => {
      if(!handle.classList.contains('grab-indicator') && !handle.parentNode.classList.contains('grab-indicator')) return false;
      
      var select = el.querySelector('select.item-status-input');
      if(select.value != "in-stock") return false;

      return true;
   }, 
   isContainer: (el) => {
      return el.classList.contains('packet') || el.classList.contains('packets');
   },
})