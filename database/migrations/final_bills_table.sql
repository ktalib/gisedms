-- Create final_bills table
CREATE TABLE final_bills (
    id INT IDENTITY(1,1) PRIMARY KEY,
    application_id INT NOT NULL,
    processing_fee DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
    survey_fee DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
    assignment_fee DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
    bill_balance DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
    ground_rent DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
    dev_charges DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
    total_amount DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
    bill_date DATE NOT NULL,
    bill_status VARCHAR(20) NOT NULL DEFAULT 'generated',
    created_at DATETIME NOT NULL DEFAULT GETDATE(),
    updated_at DATETIME NOT NULL DEFAULT GETDATE(),
    CONSTRAINT FK_final_bills_mother_applications FOREIGN KEY (application_id)
        REFERENCES mother_applications(id)
);

-- Add index for faster lookup by application_id
CREATE INDEX idx_final_bills_application_id ON final_bills(application_id);

-- Add index for bill status queries
CREATE INDEX idx_final_bills_status ON final_bills(bill_status);

-- Add comments to the table
EXEC sp_addextendedproperty 
    @name = N'MS_Description',
    @value = N'Stores final bill information for sectional titling applications',
    @level0type = N'SCHEMA', @level0name = N'dbo',
    @level1type = N'TABLE',  @level1name = N'final_bills';

-- Add comment for application_id column
EXEC sp_addextendedproperty 
    @name = N'MS_Description',
    @value = N'Foreign key to mother_applications table',
    @level0type = N'SCHEMA', @level0name = N'dbo',
    @level1type = N'TABLE',  @level1name = N'final_bills',
    @level2type = N'COLUMN', @level2name = N'application_id';

-- Add comment for bill_status column
EXEC sp_addextendedproperty 
    @name = N'MS_Description',
    @value = N'Status of the bill (generated, sent, paid, cancelled)',
    @level0type = N'SCHEMA', @level0name = N'dbo',
    @level1type = N'TABLE',  @level1name = N'final_bills',
    @level2type = N'COLUMN', @level2name = N'bill_status';

-- Add comment for dev_charges column
EXEC sp_addextendedproperty 
    @name = N'MS_Description',
    @value = N'Development charges for the property',
    @level0type = N'SCHEMA', @level0name = N'dbo',
    @level1type = N'TABLE',  @level1name = N'final_bills',
    @level2type = N'COLUMN', @level2name = N'dev_charges';
