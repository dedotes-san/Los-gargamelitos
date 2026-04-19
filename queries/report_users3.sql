-- Create admin user
CREATE USER 'mythcore_admin'@'localhost'
IDENTIFIED BY 'MythCore123';

-- Grant permissions
GRANT ALL PRIVILEGES
ON mythcore.*
TO 'mythcore_admin'@'localhost';

-- Create read-only user
CREATE USER 'mythcore_reader'@'localhost'
IDENTIFIED BY 'ReadOnly123';

-- Grant read permissions
GRANT SELECT
ON mythcore.*
TO 'mythcore_reader'@'localhost';

-- Apply changes
FLUSH PRIVILEGES;
