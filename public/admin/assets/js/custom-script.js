//Custom function for generating booking invoices using jsPDF
document.addEventListener('DOMContentLoaded', function () {
    const { jsPDF } = window.jspdf;

    document.querySelectorAll('.generate-invoice').forEach(button => {
        button.addEventListener('click', function () {
            const booking = JSON.parse(this.getAttribute('data-booking'));
            const doc = new jsPDF();

            // Company Logo (optional) - replace with your Base64 logo or skip this section
            // doc.addImage('logo_base64_here', 'PNG', 14, 10, 30, 15);

            // Invoice Title
            doc.setFontSize(20);
            doc.setTextColor(40);
            doc.text("Booking Invoice", 105, 20, { align: "center" });

            // Company Info
            doc.setFontSize(10);
            doc.setTextColor(100);
            doc.text("Your Company Name", 14, 30);
            doc.text("123 Business Street, City, Country", 14, 35);
            doc.text("Email: info@company.com | Phone: +1234567890", 14, 40);

            // Invoice Info
            doc.setFontSize(12);
            doc.setTextColor(40);
            doc.text(`Invoice #: ${booking.id}`, 150, 30);
            doc.text(`Date: ${new Date().toLocaleDateString()}`, 150, 35);
            doc.text(`Status: ${booking.status}`, 150, 40);

            // Customer Details
            doc.setFontSize(12);
            doc.text("Bill To:", 14, 50);
            doc.setFontSize(10);
            doc.text(`${booking.sender_name}`, 14, 55);
            doc.text(`${booking.pickup_address}`, 14, 60);
            doc.text(`Phone: ${booking.recipient_phone}`, 14, 65);

            // Table with booking details
            doc.autoTable({
                startY: 75,
                head: [['Item', 'Description', 'Price']],
                body: [
                    ['Recipient', booking.recipient_name, ''],
                    ['Delivery Address', booking.delivery_address, ''],
                    ['Delivery Notes', booking.delivery_notes ?? '-', ''],
                    ['Item Type', booking.item_type, ''],
                    ['Price', '', `${booking.price}`]
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
        });
    });
});
