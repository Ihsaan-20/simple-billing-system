







// function showWords(){        
//     var amount = $('#amount').val();
//     var words = convertToWords(amount);
//     $('#words').text(words);
// }

// function convertToWords(n) {
//     if (n < 0)
//         return false;

//     const single_digit = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
//     const double_digit = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
//     const below_hundred = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

//     if (n === 0) return 'Zero';

//     function translate(n) {
//         let word = '';
//         if (n < 10) {
//             word = single_digit[n] + ' ';
//         } else if (n < 20) {
//             word = double_digit[n - 10] + ' ';
//         } else if (n < 100) {
//             const rem = translate(n % 10);
//             word = below_hundred[Math.floor(n / 10) - 2] + ' ' + rem;
//         } else if (n < 1000) {
//             word = single_digit[Math.floor(n / 100)] + ' Hundred ' + translate(n % 100);
//         } else if (n < 100000) {
//             word = translate(Math.floor(n / 1000)) + ' Thousand ' + translate(n % 1000);
//         } else if (n < 10000000) {
//             word = translate(Math.floor(n / 100000)) + ' Lac ' + translate(n % 100000);
//         } else if (n < 1000000000) {
//             word = translate(Math.floor(n / 10000000)) + ' Million ' + translate(n % 10000000);
//         } else {
//             word = translate(Math.floor(n / 1000000000)) + ' Billion ' + translate(n % 1000000000);
//         }
//         return word;
//     }

//     let result = translate(n);
//     return result.trim() + ' Rupees Only';
// }

