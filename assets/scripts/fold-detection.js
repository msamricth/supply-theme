jQuery(document).ready(function($) {
    var prevValue = null;
    var truePrevValue = null;
    const getBlockList = () => wp.data.select( 'core/editor' ).getBlocks();
    let blockList = getBlockList();
    wp.data.subscribe(() => {
      const newBlockList = getBlockList();
      const blockListChanged = newBlockList !== blockList;
      blockList = newBlockList;
      if ( blockListChanged ) {
          checkFoldColorFields();
      }
    });
      var $div = $(".wp-block");
    var observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
       
          checkFoldColorFields();
          
          });
      });
    $div.each(function(i, obj) {
      observer.observe($div[i], {
        attributes: true,
        attributeFilter: ['class']
      });
    });
    $('.fold-selector select').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        checkFoldColorFields(valueSelected);
    });
    acf.add_action('ready', function( $el ){
      
      
    var field = acf.getField('field_62e8840d7c9bf');
    field.on('click', function( e ){
      field.val
      checkFoldColorFields(field.val);
  });
      
      
      // do something to $field
      
  });
    function checkFoldColorFields($clickValue=null) {
        var selectedWPBlock = $('.wp-block.is-selected');
      var SelectedWPBlockSibling = selectedWPBlock.prev(".wp-block");
      
        var prevValue = SelectedWPBlockSibling.find('.fold-selector select').val();
  
      
      if(prevValue) {
        truePrevValue = prevValue;
      }
      var selectedWPBlockFoldSelect = selectedWPBlock.find('.fold-selector select');
      if( !selectedWPBlockFoldSelect.val() ) { 
        selectPrevFold();
      } else  {
        if (selectedWPBlockFoldSelect.val().indexOf('1') !== -1) {
          selectPrevFold();
        } 
      }
  
        function selectPrevFold(){
          var valToChange = null;
        if(prevValue) {
          valToChange = prevValue;
          console.log('prev color: ' + valToChange);
        } else {
          if($clickValue){
            valToChange = $clickValue;
            console.log('click prev color: ' + valToChange);
          } else {
            valToChange = truePrevValue;
            console.log('"true" prev color: ' + valToChange);
          }
          
        }
          selectedWPBlockFoldSelect.val(valToChange);
          selectedWPBlockFoldSelect.children("option[value="+valToChange+"]").text(valToChange +' (previously selected)');
          
          
      }
    }
  });