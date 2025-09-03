#!/bin/bash

# Quick restart script for local development
# This will restart your Docker containers with updated configuration

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}🔄 Restarting Docker containers...${NC}"

# Stop containers
docker-compose down

# Start containers
docker-compose up -d

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Containers restarted successfully!${NC}"
    echo ""
    echo -e "${GREEN}🌐 Your application is now available at:${NC}"
    echo "   http://localhost:8080"
    echo ""
    echo -e "${YELLOW}📊 Access URLs:${NC}"
    echo "• Main Application: http://localhost:8080"
    echo "• phpMyAdmin: http://localhost:8081"
    echo "• Database: localhost:3307"
    echo ""
    echo -e "${YELLOW}🔐 Database credentials:${NC}"
    echo "Host: localhost:3307 (external) or db:3306 (from container)"
    echo "Database: hmsindiaivf_dev"
    echo "Username: root"
    echo "Password: (empty)"
    echo ""
else
    echo -e "${RED}❌ Failed to restart containers${NC}"
    echo "Check the logs: docker-compose logs"
fi
