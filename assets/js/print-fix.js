/**
 * Enhanced Print Utility for HMS Application
 * Fixes popup blocking and redirect issues
 */

// Global print function that handles popup blocking
function printDiv(divId = 'print_this_section') {
    try {
        // Hide elements that shouldn't print
        $('.hide_print').hide();
        $('input[type="submit"]').css('visibility', 'hidden');
        $('p#last_updated').css('visibility', 'hidden');
        
        var divToPrint = document.getElementById(divId);
        
        if (!divToPrint) {
            alert('Print section not found!');
            return;
        }
        
        // Try to open popup window first
        var newWin = window.open('', 'Print-Window', 'width=800,height=600,scrollbars=yes,resizable=yes,menubar=no,toolbar=no,location=no,status=no');
        
        if (newWin && !newWin.closed) {
            // Popup was not blocked - use popup method
            newWin.document.open();
            newWin.document.write(`
                <html>
                <head>
                    <title>Print Document</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        table { border-collapse: collapse; width: 100%; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                        @media print {
                            body { margin: 0; }
                            .no-print { display: none !important; }
                        }
                    </style>
                </head>
                <body onload="window.print(); setTimeout(function(){window.close();}, 1000);">
                    ${divToPrint.innerHTML}
                </body>
                </html>
            `);
            newWin.document.close();
        } else {
            // Popup was blocked - use direct print method
            var printContents = divToPrint.innerHTML;
            var originalContents = document.body.innerHTML;
            
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
        
        // Restore elements after printing
        setTimeout(function(){
            $('.hide_print').show();
            $('input[type="submit"]').css('visibility', 'visible');
            $('p#last_updated').css('visibility', 'visible');
        }, 1000);
        
    } catch (error) {
        console.error('Print error:', error);
        alert('Print failed. Please try again or check your browser settings.');
    }
}

// Enhanced follow print function
function followPrint(printId) {
    try {
        $('tr#followlogo_tr').css('display', 'table-row');
        var divToPrint = document.getElementById(printId);
        
        if (!divToPrint) {
            alert('Print section not found!');
            return;
        }
        
        // Try to open popup window first
        var newWin = window.open('', 'Print-Window', 'width=800,height=600,scrollbars=yes,resizable=yes,menubar=no,toolbar=no,location=no,status=no');
        
        if (newWin && !newWin.closed) {
            // Popup was not blocked
            newWin.document.open();
            newWin.document.write(`
                <html>
                <head>
                    <title>Print Document</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        table { border-collapse: collapse; width: 100%; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                        @media print {
                            body { margin: 0; }
                            .no-print { display: none !important; }
                        }
                    </style>
                </head>
                <body onload="window.print(); setTimeout(function(){window.close();}, 1000);">
                    ${divToPrint.innerHTML}
                </body>
                </html>
            `);
            newWin.document.close();
        } else {
            // Popup was blocked - use direct print method
            var printContents = divToPrint.innerHTML;
            var originalContents = document.body.innerHTML;
            
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
        
    } catch (error) {
        console.error('Follow print error:', error);
        alert('Print failed. Please try again or check your browser settings.');
    }
}

// Fix redirect issues
function safeRedirect(url) {
    try {
        if (url && url !== '') {
            window.location.href = url;
        } else {
            window.history.back();
        }
    } catch (error) {
        console.error('Redirect error:', error);
        window.history.back();
    }
}

// Enhanced back button function
function goBack() {
    try {
        if (window.history.length > 1) {
            window.history.back();
        } else {
            window.location.href = base_url || '/';
        }
    } catch (error) {
        console.error('Back navigation error:', error);
        window.location.href = base_url || '/';
    }
}

// Initialize when document is ready
$(document).ready(function() {
    // Override existing print functions
    if (typeof window.originalPrintDiv === 'undefined') {
        window.originalPrintDiv = window.printDiv;
        window.printDiv = printDiv;
    }
    
    // Fix follow print button clicks
    $(document).off('click', 'a.followprint_btn').on('click', 'a.followprint_btn', function(e) {
        e.preventDefault();
        var printId = $(this).data('printid');
        followPrint(printId);
    });
    
    // Fix back button clicks
    $('button[onclick*="window.history.go(-1)"]').off('click').on('click', function(e) {
        e.preventDefault();
        goBack();
    });
    
    // Fix redirect links
    $('a[href*="redirect"]').off('click').on('click', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        safeRedirect(href);
    });
});
