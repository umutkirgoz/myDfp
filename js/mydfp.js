(function(w, d, $){   
    
    w.googletag = w.googletag || {};
    w.googletag.cmd = w.googletag.cmd || [];
    
    var placements;
    $(function(){
        placements = $('.mydfp');
        init();
    });
    function init(){
        console.log(placements); 
        
        
        googletag.cmd.push(function() {
            buildSlots();
            
            renderSlots();
            
        });
        
        
        
        
    }
    
    
    
    function buildSlots() {        
        $.each(placements, function(){
            var $this = $(this);
            console.log($this.data());
            
            var code = '/'+myDfp.networkId+'/'+$this.data('slot-code');
            
            var s = $this.data('slot-sizes').split('|'), sizes = [],ss;
            for (var i=0;i<s.length;i++){
                ss = s[i].split(',');
                ss[0] = parseInt(ss[0]);
                ss[1] = parseInt(ss[1]);
                sizes.push(ss);
            }
            console.log(sizes);
            
            var id = $this.attr('id');
            
            googletag.defineSlot(code, sizes, id).addService(googletag.pubads());
            
        });
        
        googletag.pubads().enableSingleRequest();
        googletag.enableServices();
    }
    
    function renderSlots(){
        
         $.each(placements, function(){
            var $this = $(this);
           
            
            var id = $this.attr('id');
            
            googletag.display(id);
            
        });
        
        
    }
    
    
}(window, document, jQuery));
