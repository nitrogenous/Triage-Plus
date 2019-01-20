from numpy import exp, array, random, dot
import matplotlib.pyplot as plt
import sys, json

class NeuralNetwork():
	
	def __init__(self):
		self.weight = 2 * random.random((3,1)) - 1

	def sigmoid(self,x):
		return 1.0 / (1.0+exp(-x))

	def sigmoid_derivative(self,x):
		return x * (1.0-x)

	def think(self,inputs):
		return self.sigmoid(dot(inputs,self.weight))

	def train(self,trainData_inputs,trainData_outputs,epochs):
		for epoch in range(epochs):
			predict = self.think(trainData_inputs)
			bias = trainData_outputs - predict
			adjustment = dot(trainData_inputs.T, bias * self.sigmoid_derivative(predict))
			self.weight += adjustment


neural = NeuralNetwork()

userData = sys.argv[1]
userData = json.loads(userData)
# print userData['age']
# print neural.weight

trainData_inputs = array([[0.0, 0.0, 1.0], [1.0, 1.0, 1.0], [1.0, 0.0, 1.0], [0.0, 1.0, 1.0]])
trainData_outputs = array([[0, 1, 1, 0]]).T

neural.train(trainData_inputs, trainData_outputs, 10)

# print neural.weight

print neural.think(array([float(userData['gender']), float(userData['age']), float(userData['weight'])]))