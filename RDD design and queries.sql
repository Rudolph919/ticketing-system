Table: Customers
Fields:
CustomerID (integer, primary key)
FirstName (varchar)
LastName (varchar)
Email (varchar)
Phone (varchar)
Address (varchar)

Table: Products
Fields:
ProductID (integer, primary key)
Name (varchar)
Description (text)
Price (decimal)
CategoryID (integer, foreign key referencing Categories.CategoryID)
SupplierID (integer, foreign key referencing Suppliers.SupplierID)

Table: Categories
Fields:
CategoryID (integer, primary key)
Name (varchar)
Description (text)

Table: Suppliers
Fields:
SupplierID (integer, primary key)
Name (varchar)
Email (varchar)
Phone (varchar)
Address (varchar)

Table: Stock
Fields:
StockID (integer, primary key)
ProductID (integer, foreign key referencing Products.ProductID)
SupplierID (integer, foreign key referencing Suppliers.SupplierID)
PurchaseDate (datetime)
PurchasePrice (decimal)
Quantity (integer)

Table: Sales
Fields:
SaleID (integer, primary key)
CustomerID (integer, foreign key referencing Customers.CustomerID)
SalespersonID (integer, foreign key referencing Salespersons.SalespersonID)
SaleDate (datetime)
Table: SalesItems
Fields:

SaleItemID (integer, primary key)
SaleID (integer, foreign key referencing Sales.SaleID)
ProductID (integer, foreign key referencing Products.ProductID)
Quantity (integer)
SalePrice (decimal)
Table: Salespersons
Fields:

SalespersonID (integer, primary key)
FirstName (varchar)
LastName (varchar)
Email (varchar)
Phone (varchar)


Top 10 customers by purchase (cost) - BIG SPENDERS:

SELECT TOP 10 C.CustomerID, C.FirstName, C.LastName, SUM(S.TotalCost) AS TotalPurchaseCost
FROM Customers C
JOIN Sales S ON C.CustomerID = S.CustomerID
GROUP BY C.CustomerID, C.FirstName, C.LastName
ORDER BY TotalPurchaseCost DESC;


Top 10 customers by purchase (count) - QUANTITY OVER QUALITY:

SELECT TOP 10 C.CustomerID, C.FirstName, C.LastName, COUNT(S.SaleID) AS TotalPurchaseCount
FROM Customers C
JOIN Sales S ON C.CustomerID = S.CustomerID
GROUP BY C.CustomerID, C.FirstName, C.LastName
ORDER BY TotalPurchaseCount DESC;


Top 3 Salespeople by Net Profit on Sales:

SELECT TOP 3 SP.SalespersonID, SP.FirstName, SP.LastName, (SUM(S.TotalCost) - SUM(P.Price * S.Quantity)) AS NetProfit
FROM Salespersons SP
JOIN Sales S ON SP.SalespersonID = S.SalespersonID
JOIN Products P ON S.ProductID = P.ProductID
GROUP BY SP.SalespersonID, SP.FirstName, SP.LastName
ORDER BY NetProfit DESC;


Top 3 Salespeople by Gross Sales value:

SELECT TOP 3 SP.SalespersonID, SP.FirstName, SP.LastName, SUM(S.TotalCost) AS GrossSales
FROM Salespersons SP
JOIN Sales S ON SP.SalespersonID = S.SalespersonID
GROUP BY SP.SalespersonID, SP.FirstName, SP.LastName
ORDER BY GrossSales DESC;
