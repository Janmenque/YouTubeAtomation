import React from 'react';
import { useAuth } from '../../contexts/AuthContext';
import { Button, Container, Row, Col, Card } from 'react-bootstrap';

const Login = () => {
  const { login } = useAuth();

  return (
    <Container className="mt-5">
      <Row className="justify-content-center">
        <Col md={6}>
          <Card>
            <Card.Body className="text-center">
              <Card.Title>YouTube Automation</Card.Title>
              <Card.Text>
                Connect your YouTube account to manage videos and analytics
              </Card.Text>
              <Button variant="danger" onClick={login}>
                <i className="fab fa-youtube me-2"></i>Connect YouTube Account
              </Button>
            </Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
  );
};

export default Login;