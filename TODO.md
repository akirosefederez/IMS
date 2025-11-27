# TODO List for Checkout Feature

- [x] Add "Checkout" button next to delete button in action column for each check-in item
- [x] Create checkout modal with options: Delivery, Returned, Borrowed Item, Purchase Return
- [x] Implement backend logic for checkout actions and inventory management
- [x] Remove quantity option and make it fixed/default (full checkin quantity)
- [x] Route products to appropriate tables based on checkout type (Delivery->OrderItem, Returned->ReturnSlip, Borrowed->Borrower, Purchase Return->PurchaseReturn)
- [x] Test the checkout functionality
