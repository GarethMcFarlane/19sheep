window.onload = function() {
    var R = Raphael("canvas", 800, 500),
        
        lRect = R.rect(0, 0, 200, 500).attr({
            fill: "hsb(0.65, 1, 1)",
            stroke: "none",
            opacity: .6
        }),
    	rRect = R.rect(600, 0, 200, 500).attr({
            fill: "hsb(0.175, 1, 1)",
            stroke: "none",
            opacity: .6
        }),
        c = R.circle(400, 250, 50).attr({
            fill: "hsb(0.5,0.6,0.6)",
            stroke: "none",
            opacity: 1
        });
    var start = function () {
        // storing original coordinates
        this.ox = this.attr("cx");    
        this.oy = this.attr("cy");
        
        this.sizer.ox = this.sizer.attr("cx");    
        this.sizer.oy = this.sizer.attr("cy")
            
        this.attr({opacity: 1});
        this.sizer.attr({opacity: 1});
    },
    move = function (dx, dy) {
        // move will be called with dx and dy
        this.attr({cx: this.ox + dx, cy: this.oy});
        this.sizer.attr({cx: this.sizer.ox +dx, cy: this.sizer.oy});
    },
    up = function () {
        // restoring state
        this.attr({opacity: 1});
        this.sizer.attr({opacity: 1});
    },
    rstart = function() {
        // storing original coordinates
        this.ox = this.attr("cx");
        this.oy = this.attr("cy");        
        
        this.big.or = this.big.attr("r");
    },
    rmove = function (dx, dy) {
        // move will be called with dx and dy
        this.attr({cx: this.ox, cy: this.oy});					   
		var newR = this.big.or + ((dy < 0 ? -1 : 1) * Math.sqrt(2 * dy * dy));
        if (newR <= 20) {
            newR = 20;
        }
        if (newR <= 85){
            this.attr({fill: "hsb(.0,1,1)"});
        } else if (newR > 85){
            this.attr({fill: "hsb(.350,1,1)"});
        } 
        if (newR >= 150) {
            newR = 200;
        }
            

        this.big.attr({
            r: newR
        });
    };
    c.drag(move, start, up);    
    c.sizer = c;
    c.big = c;
    c.drag(rmove,rstart);
};