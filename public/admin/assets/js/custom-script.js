    //Custom function for generating booking invoices using jsPDF
    document.addEventListener('DOMContentLoaded', function () {
        const { jsPDF } = window.jspdf;
    
        document.querySelectorAll('.generate-invoice').forEach(button => {
            button.addEventListener('click', function () {
                const booking = JSON.parse(this.getAttribute('data-booking'));
                const doc = new jsPDF();
    
                // --- Load Logo First ---
                const logo = new Image();
                logo.src = "/booking/public/images/logo-pdf.png"; // relative path (recommended)
    
                logo.onload = function () {
                    // Add Logo
                    doc.addImage(logo, "PNG", 14, 10, 40, 10);
    
                    // Invoice Title
                    doc.setFontSize(20);
                    doc.setTextColor(40);
                    doc.text("Booking Invoice", 105, 20, { align: "center" });
    
                    // Company Info
                    doc.setFontSize(10);
                    doc.setTextColor(100);
                    doc.text("RR LOGISTIC INTERNATIONAL PTY LTD", 14, 32);
                    doc.text("Unit 2, 771 Warrigal Road BENTLEIGH EAST VIC 3165", 14, 37);
                    doc.text("ACN: 689695805 | ABN: 79689695805", 14, 42);
                    doc.text("GST Registered: Yes | Date Registered: 04 Aug 2025", 14, 47);
    
                    // Invoice Info
                    doc.setFontSize(12);
                    doc.setTextColor(40);
                    doc.text(`Invoice #: ${booking.id}`, 150, 32);
                    doc.text(`Date: ${new Date().toLocaleDateString()}`, 150, 37);
                    doc.text(`Status: ${booking.status}`, 150, 42);
    
                    // Customer Details
                    doc.setFontSize(12);
                    doc.text("Bill To:", 14, 55);
                    doc.setFontSize(10);
                    let currentY = 60;
                    doc.text(`${booking.sender_name}`, 14, currentY);
                    currentY += 5;
                    doc.text(`${booking.pickup_address}`, 14, currentY);
                    currentY += 5;
                    doc.text(`Phone: ${booking.recipient_phone}`, 14, currentY);
                    currentY += 10;
    
                    // Price Calculations
                    const totalPrice = parseFloat(booking.price) || 0;
                    const basePrice = totalPrice / 1.10;
                    const gst = totalPrice - basePrice;
    
                    // Table
                    doc.autoTable({
                        startY: currentY,
                        head: [['Item', 'Description', 'Price']],
                        body: [
                            ['Recipient', booking.recipient_name, ''],
                            ['Delivery Address', booking.delivery_address, ''],
                            ['Delivery Notes', booking.delivery_notes ?? '-', ''],
                            ['Item Type', booking.item_type, ''],
                            ['Price', '', basePrice.toFixed(2)],
                            ['GST (10%)', '', gst.toFixed(2)],
                            ['Total', '', totalPrice.toFixed(2)]
                        ],
                        theme: 'striped',
                        headStyles: { fillColor: [41, 128, 185] },
                        bodyStyles: { textColor: 50 },
                        styles: { fontSize: 10 }
                    });
    
                    // Footer
                    const pageHeight = doc.internal.pageSize.height;
                    doc.setFontSize(10);
                    doc.setTextColor(150);
                    doc.text("Thank you for your business!", 105, pageHeight - 20, { align: "center" });
    
                    // Save PDF
                    doc.save(`booking-${booking.id}-invoice.pdf`);
                };
            });
        });
    });


// Shipping Label / Delivery Docket
document.addEventListener('DOMContentLoaded', function () {
    const { jsPDF } = window.jspdf;

    document.querySelectorAll('.generate-label').forEach(button => {
        button.addEventListener('click', function () {
            const booking = JSON.parse(this.getAttribute('data-booking'));
            const doc = new jsPDF({
                orientation: "portrait",
                unit: "mm",
                format: [100, 150] // label size
            });

            const logo = new Image();
            logo.src = "/booking/public/images/logo-pdf.png";

            logo.onload = function () {
                // === Header Section ===
                // Logo smaller & fixed position
                doc.addImage(logo, "PNG", 8, 8, 20, 8); // (x,y,width,height)

                // Company Info aligned right but BELOW top edge of logo
                doc.setFontSize(8);
                doc.setFont("helvetica", "bold");
                doc.text("RR LOGISTIC INTERNATIONAL PTY LTD", 90, 12, { align: "right" });

                doc.setFont("helvetica", "normal");
                doc.text("Unit 2, 771 Warrigal Road", 90, 16, { align: "right" });
                doc.text("Bentleigh East VIC 3165", 90, 20, { align: "right" });
                doc.text("ABN: 79689695805", 90, 24, { align: "right" });
                doc.text("Date: " + new Date().toLocaleDateString(), 90, 28, { align: "right" });

                // Divider line
                doc.setLineWidth(0.5);
                doc.line(10, 34, 90, 34);

                // === Title ===
                doc.setFontSize(14);
                doc.setFont("helvetica", "bold");
                doc.text("DELIVERY DOCKET", 50, 42, { align: "center" });

                // === From (Sender) Section ===
                doc.setLineWidth(0.3);
                doc.rect(10, 50, 80, 30); // box
                doc.setFontSize(10);
                doc.setFont("helvetica", "bold");
                doc.text("FROM:", 12, 56);
                doc.setFont("helvetica", "normal");
                doc.text(`Name: ${booking.sender_name}`, 12, 62);
                doc.text(`Address: ${booking.pickup_address}`, 12, 68);
                doc.text(`Phone: ${booking.sender_phone}`, 12, 74);

                // === To (Recipient) Section ===
                doc.rect(10, 84, 80, 30); // box
                doc.setFont("helvetica", "bold");
                doc.text("TO:", 12, 90);
                doc.setFont("helvetica", "normal");
                doc.text(`Name: ${booking.recipient_name}`, 12, 96);
                doc.text(`Address: ${booking.delivery_address}`, 12, 102);
                doc.text(`Phone: ${booking.recipient_phone}`, 12, 108);

                // === Notes Section ===
                if (booking.delivery_notes) {
                    doc.rect(10, 118, 80, 20);
                    doc.setFont("helvetica", "bold");
                    doc.text("NOTES:", 12, 124);
                    doc.setFont("helvetica", "normal");
                    doc.text(doc.splitTextToSize(booking.delivery_notes, 75), 12, 130);
                }

                // === Border Around Label ===
                doc.setLineWidth(0.7);
                doc.rect(5, 5, 90, 140);

                // Auto print
                doc.autoPrint();
                window.open(doc.output('bloburl'), '_blank');
            };
        });
    });
});
