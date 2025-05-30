import React, { useState } from 'react';
import { Form, Button, Row, Col, Card, Spinner, Alert } from 'react-bootstrap';
import axios from 'axios';

const UploadForm = () => {
  const [formData, setFormData] = useState({
    title: '',
    description: '',
    tags: '',
    privacyStatus: 'private',
    scheduleDate: '',
    videoFile: null
  });
  const [uploadProgress, setUploadProgress] = useState(0);
  const [isUploading, setIsUploading] = useState(false);
  const [error, setError] = useState(null);
  const [success, setSuccess] = useState(null);

  const handleChange = (e) => {
    const { name, value, files } = e.target;
    setFormData({
      ...formData,
      [name]: files ? files[0] : value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsUploading(true);
    setError(null);
    setSuccess(null);

    try {
      const data = new FormData();
      data.append('title', formData.title);
      data.append('description', formData.description);
      data.append('tags', formData.tags);
      data.append('privacyStatus', formData.privacyStatus);
      if (formData.scheduleDate) {
        data.append('scheduleDate', formData.scheduleDate);
      }
      data.append('videoFile', formData.videoFile);

      const response = await axios.post('http://your-php-backend.com/api/videos/upload', data, {
        withCredentials: true,
        onUploadProgress: (progressEvent) => {
          const progress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
          setUploadProgress(progress);
        }
      });

      setSuccess('Video uploaded successfully!');
      setUploadProgress(0);
    } catch (err) {
      setError(err.response?.data?.message || 'Upload failed');
    } finally {
      setIsUploading(false);
    }
  };

  return (
    <Card className="mb-4">
      <Card.Header>Upload Video</Card.Header>
      <Card.Body>
        {error && <Alert variant="danger">{error}</Alert>}
        {success && <Alert variant="success">{success}</Alert>}
        
        <Form onSubmit={handleSubmit}>
          <Form.Group className="mb-3">
            <Form.Label>Video File</Form.Label>
            <Form.Control 
              type="file" 
              name="videoFile" 
              onChange={handleChange} 
              accept="video/*" 
              required 
            />
          </Form.Group>

          <Form.Group className="mb-3">
            <Form.Label>Title</Form.Label>
            <Form.Control 
              type="text" 
              name="title" 
              value={formData.title} 
              onChange={handleChange} 
              required 
            />
          </Form.Group>

          <Form.Group className="mb-3">
            <Form.Label>Description</Form.Label>
            <Form.Control 
              as="textarea" 
              rows={3} 
              name="description" 
              value={formData.description} 
              onChange={handleChange} 
            />
          </Form.Group>

          <Form.Group className="mb-3">
            <Form.Label>Tags (comma separated)</Form.Label>
            <Form.Control 
              type="text" 
              name="tags" 
              value={formData.tags} 
              onChange={handleChange} 
              placeholder="tag1, tag2, tag3" 
            />
          </Form.Group>

          <Row className="mb-3">
            <Col md={6}>
              <Form.Group>
                <Form.Label>Privacy Status</Form.Label>
                <Form.Select 
                  name="privacyStatus" 
                  value={formData.privacyStatus} 
                  onChange={handleChange}
                >
                  <option value="private">Private</option>
                  <option value="unlisted">Unlisted</option>
                  <option value="public">Public</option>
                </Form.Select>
              </Form.Group>
            </Col>
            <Col md={6}>
              <Form.Group>
                <Form.Label>Schedule Upload (optional)</Form.Label>
                <Form.Control 
                  type="datetime-local" 
                  name="scheduleDate" 
                  value={formData.scheduleDate} 
                  onChange={handleChange} 
                />
              </Form.Group>
            </Col>
          </Row>

          {isUploading && (
            <div className="mb-3">
              <div className="d-flex justify-content-between">
                <span>Uploading: {uploadProgress}%</span>
                <Spinner animation="border" size="sm" />
              </div>
              <div className="progress">
                <div 
                  className="progress-bar" 
                  role="progressbar" 
                  style={{ width: `${uploadProgress}%` }}
                ></div>
              </div>
            </div>
          )}

          <Button variant="primary" type="submit" disabled={isUploading}>
            {isUploading ? 'Uploading...' : 'Upload Video'}
          </Button>
        </Form>
      </Card.Body>
    </Card>
  );
};

export default UploadForm;