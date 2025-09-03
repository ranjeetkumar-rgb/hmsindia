#!/bin/bash

# HMS India Local Development Setup Script
# This script sets up your local development environment with Docker

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${GREEN}🚀 Setting up HMS India Local Development Environment...${NC}"

# Check if we're in the right directory
if [ ! -d "application" ]; then
    echo -e "${RED}❌ Error: Please run this script from the project root directory${NC}"
    echo "   (The directory containing the 'application' folder)"
    exit 1
fi

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo -e "${RED}❌ Docker is not installed. Please install Docker first.${NC}"
    echo "Visit: https://docs.docker.com/get-docker/"
    exit 1
fi

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo -e "${RED}❌ Docker Compose is not installed. Please install Docker Compose first.${NC}"
    echo "Visit: https://docs.docker.com/compose/install/"
    exit 1
fi

echo -e "${YELLOW}📋 Setting up configuration files...${NC}"

# Create database configuration if it doesn't exist
if [ ! -f "application/config/database.php" ]; then
    echo -e "${BLUE}📝 Creating database configuration...${NC}"
    cp application/config/database.php.example application/config/database.php
    echo -e "${GREEN}✅ Database configuration created${NC}"
else
    echo -e "${YELLOW}⚠️  Database configuration already exists${NC}"
fi

# Create application configuration if it doesn't exist
if [ ! -f "application/config/config.php" ]; then
    echo -e "${BLUE}📝 Creating application configuration...${NC}"
    cp application/config/config.php.example application/config/config.php
    echo -e "${GREEN}✅ Application configuration created${NC}"
else
    echo -e "${YELLOW}⚠️  Application configuration already exists${NC}"
fi

# Create .env file for local development
if [ ! -f ".env" ]; then
    echo -e "${BLUE}📝 Creating environment file...${NC}"
    cp env.local .env
    echo -e "${GREEN}✅ Environment file created${NC}"
else
    echo -e "${YELLOW}⚠️  Environment file already exists${NC}"
fi

echo -e "${YELLOW}🐳 Building and starting Docker containers...${NC}"

# Stop any existing containers
docker-compose down 2>/dev/null || true

# Build and start containers
docker-compose up -d --build

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Docker containers started successfully!${NC}"
else
    echo -e "${RED}❌ Failed to start Docker containers${NC}"
    exit 1
fi

# Wait for services to be ready
echo -e "${YELLOW}⏳ Waiting for services to be ready...${NC}"
sleep 30

# Check container status
echo -e "${YELLOW}📊 Checking container status...${NC}"
docker-compose ps

# Show logs if there are issues
if ! docker-compose ps | grep -q "Up"; then
    echo -e "${RED}⚠️  Some containers may not be running. Showing logs:${NC}"
    docker-compose logs
fi

echo -e "${GREEN}🎉 Local development environment setup completed!${NC}"
echo ""
echo -e "${YELLOW}📋 Development Environment Summary:${NC}"
echo "✅ Docker containers built and started"
echo "✅ MySQL database container running (development database)"
echo "✅ phpMyAdmin available for database management"
echo "✅ Application configured for development"
echo ""
echo -e "${GREEN}🌐 Access URLs:${NC}"
echo "• Main Application: http://localhost:8080"
echo "• phpMyAdmin: http://localhost:8081"
echo "• Database: localhost:3307"
echo ""
echo -e "${GREEN}🔐 Database Credentials (Local Development):${NC}"
echo "• Host: localhost:3307 (external) or db:3306 (from container)"
echo "• Database: hmsindiaivf_dev"
echo "• Username: root"
echo "• Password: (empty)"
echo ""
echo -e "${BLUE}💡 Useful Commands:${NC}"
echo "• View logs: docker-compose logs"
echo "• Stop containers: docker-compose down"
echo "• Restart containers: docker-compose restart"
echo "• Access database: docker exec -it hmsindia_db mysql -u root -p"
echo "• Access application container: docker exec -it hmsindia_web bash"
echo ""
echo -e "${YELLOW}📝 Next Steps:${NC}"
echo "1. Import your development database if needed"
echo "2. Start developing your application"
echo "3. Use 'docker-compose down' to stop when done"
echo "4. Use 'docker-compose up -d' to start again"
