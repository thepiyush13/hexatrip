
 
$(document).ready(function(){
    
 /*********** INIT*********************/
// alert('dd');
 $('#students-grid table').dataTable( {
      
        "sPaginationType": "full_numbers"
    } );
    
 /************************** USERVOICE FORM *************************/
 (function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/zHIFfRr3oGCQZVbReiqOkg.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})()
    UserVoice = window.UserVoice || [];
UserVoice.push(['showTab', 'classic_widget', {
  mode: 'full',
  primary_color: '#cc6d00',
  link_color: '#007dbf',
  default_mode: 'support',
  forum_id: 241894,
  tab_label: 'Feedback & Contact',
  tab_color: '#000000',
  tab_position: 'middle-right',
  tab_inverted: false
}]);
 
 /****************************************************************/
 
 /************************** GOOGLE ANALYTICS *************************/
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47261902-1', 'hexatrip.com');
  ga('send', 'pageview');
 
 /****************************************************************/
  
});


 /**************** //for jqchart drawing chart s  **********************/  
    
  // Our data renderer function, returns an array of the form:
  // [[[x1, sin(x1)], [x2, sin(x2)], ...]]
  function dashboard_charts(result) {
    
// var plot1_data = result['per'];
//  var plot2_data = result['speed'];
//  var plot1_avg = result['per_avg'];
//  var plot2_avg = result['speed_avg'];
  
  var plot1 = $.jqplot('chart1', result,{
    title: "% in each test(Target:80% Verbal,95% Quant)",
    axes:{yaxis:{min:0, max:100}},
    dataRendererOptions: {
      unusedOptionalUrl: ''
    },
     seriesDefaults: { 
        showMarker:false,
        pointLabels: { show:true } 
      },
      
      canvasOverlay: {
        show: true,
        objects: [
          { rectangle: { ymin: 80, xminOffset: "0px", xmaxOffset: "0px", yminOffset: "0px", ymaxOffset: "0px",
                    color: "rgba(154,205,50, 0.3)", showTooltip: true, tooltipFormatString: "Target" } },
             {horizontalLine: {
                    name: 'Average',
                    y: result,
                    lineWidth: 1,
                    color: 'rgb(89, 198, 154,0.3)',
                    shadow: false,
                    xminOffset: '0px',
                    xmaxOffset: '200px'
                }}
          
        ]
      } 
  });
 
  var plot2 = $.jqplot('chart2', plot2_data,{
    axes:{yaxis:{min:0, max:5}},
    title: "speed(Mins/Q) in each test(Target: 1 Min/Q)",
    seriesDefaults: { 
        showMarker:false,
        pointLabels: { show:true } 
      },
       
     canvasOverlay: {
        show: true,
        objects: [
          { rectangle: { ymax: 1, xminOffset: "0px", xmaxOffset: "0px", yminOffset: "0px", ymaxOffset: "0px",
                    color: "rgba(154,205,50, 0.3)", showTooltip: true, tooltipFormatString: "Target" } },
            {horizontalLine: {
                    name: 'Average',
                    y: plot2_avg,
                    lineWidth: 1,
                    color: 'rgb(89, 198, 154,0.3)',
                    shadow: false,
                    xminOffset: '0px',
                    xmaxOffset: '200px'
                }}
          
        ]
      } 
            
    
  });
  
  }
  /**************** //for jqchart drawing chart s  **********************/ 