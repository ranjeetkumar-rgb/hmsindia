#!/bin/bash

# Fix sessions directory issue
# This script creates the sessions directory and restarts containers

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}🔧 Creating sessions directory...${NC}"

# Create sessions directory locally
if [ ! -d "application/cache/sessions" ]; then
    mkdir -p application/cache/sessions
    echo -e "${GREEN}✅ Created local sessions directory${NC}"
else
    echo -e "${YELLOW}⚠️  Sessions directory already exists locally${NC}"
fi

echo -e "${GREEN}🔄 Restarting Docker containers...${NC}"

# Stop containers
docker-compose down

# Start containers
docker-compose up -d --build

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Containers restarted successfully!${NC}"
    echo ""
    echo -e "${GREEN}🔧 Creating sessions directory in container...${NC}"
    
    # Create sessions directory in container
    docker exec hmsindia_web mkdir -p /var/www/html/application/cache/sessions
    docker exec hmsindia_web chmod -R 777 /var/www/html/application/cache
    
    echo -e "${GREEN}✅ Sessions directory created in container${NC}"
    echo ""
    echo -e "${GREEN}🌐 Your application is now available at:${NC}"
    echo "   http://localhost:8080"
    echo ""
    echo -e "${GREEN}📊 The sessions error should now be fixed!${NC}"
    echo ""
else
    echo -e "${RED}❌ Failed to restart containers${NC}"
    echo "Check the logs: docker-compose logs"
fi
