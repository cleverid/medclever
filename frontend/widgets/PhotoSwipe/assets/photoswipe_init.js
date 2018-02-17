var PhotoSwipeGallery = function(itemSelector) {
    this.selector = itemSelector;
    this.pswpElement = document.querySelectorAll('.pswp')[0];
};

PhotoSwipeGallery.prototype = {
    init: function() {
        var hashData = this.parseHash();
        if(hashData.pid && hashData.gid) {
            this.open( parseInt(hashData.pid, 10) - 1);
        }
        this.initClick();
    },
    initClick: function() {
        var images = document.querySelectorAll(this.selector), i, self = this;

        for(i = 0; i < images.length; i++) {
            images[i].onclick = (function(index){
                return function(){
                    self.open(index);
                    return false;
                };
            })(i);
        }
    },
    open: function(index) {
        var gallery, options, items,
            pswpElement = this.pswpElement;

        items = this.parseItems(this.selector);
        if(!items.length) return;

        // define options (if needed)
        options = {
            index: index,
            shareEl: false
        };

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    },
    parseItems: function(selector) {
        var images = document.querySelectorAll(selector),
            i, items = [], size;

        for(i = 0; i < images.length; i++) {
            var img = images[i],
                thumb = img.firstElementChild;

            size = img.getAttribute('data-size').split('x');
            items.push({
                src: img.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10),
                title: thumb.getAttribute('alt')
            });
        }

        return items
    },
    parseHash: function() {
        var hash = window.location.hash.substring(1),
            params = {};

        if(hash.length < 5) {
            return params;
        }

        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');
            if(pair.length < 2) {
                continue;
            }
            params[pair[0]] = pair[1];
        }

        if(params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    }
};