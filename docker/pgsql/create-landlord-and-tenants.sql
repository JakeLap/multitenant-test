SELECT 'CREATE DATABASE landlord'
WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = 'landlord')\gexec

SELECT 'CREATE DATABASE tenant1'
WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = 'tenant1')\gexec

SELECT 'CREATE DATABASE tenant2'
WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = 'tenant2')\gexec
