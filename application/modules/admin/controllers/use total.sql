use total


--- Query Items
Select *, DATE_FORMAT(date_billing,'%d/%m/%Y') AS niceDate from header_billing
INNER join client
on client.id_client = header_billing.id_client 
LEFT join status_paid 
on status_paid.id_paid = header_billing.id_paid

SELECT  *FROM header_billing 
inner JOIN  billing_items  
on header_billing.id_billing = billing_items.id_billing
inner join product
on billing_items.id_product = product.id_product
inner join group_taxes
on group_taxes.id_grouptax = product.id_grouptax
where billing_items.id_billing = 27

Select *from Company






 