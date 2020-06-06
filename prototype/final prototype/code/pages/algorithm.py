#!/usr/bin/env python
# coding: utf-8

# # Algorithm
# ## Graduation project - Annemijn Portier

# ----
# This file shows how the algorithm is executed with new data from the prototype.

# ----
# ## Database connection
# First, a connection will be made to the database to retrieve the data.

# In[43]:


#!/usr/bin/env python
import pymysql
import pandas as pd
import seaborn as sns
import matplotlib.pyplot as plt
from sklearn.model_selection import train_test_split 
#Import Random Forest Model
from sklearn.ensemble import RandomForestClassifier
import numpy as np
import mysql.connector

#connect to database on localhost
mydb = mysql.connector.connect(host='localhost',
                                         database='loans',
                                         user='root',
                                         password='')


# The table data is retrieved and placed in a data frame. This data shows the data of customers who have already applied for a loan on Geld.nl

# In[44]:


pd.set_option('display.max_columns', None) #show all columns
df = pd.read_sql("select * from data", mydb) #create new data frame
df.head()


# In[45]:


df.info()


# ----
# ## Predicting variable review score
# The variable review score will be predicted with the new data of the prototype.

# In[ ]:


y = df['reviewScore']#create the y-variable
X = df[['loanPurpose', 'loanAmount', 'age', 'typeIncome', 'netIncome','agePartner','typeIncomePartner', 
               'netIncomePartner','children','positionProduct','consumptionValues', 'goals']]
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3, random_state=44) #split the data into test and training set


#Create a Gaussian Classifier
rf=RandomForestClassifier(bootstrap= True, max_depth= None, max_features= 3, min_samples_split= 8, n_estimators= 343)

#Train the model using the training sets y_pred=clf.predict(X_test)
rf=rf.fit(X_train,y_train)

y_pred_rs=rf.predict(X_test)


# The table customerdata is retrieved and placed in a data frame. This data shows the new data that has been retrieved from the prototype where new customers want to apply for a loan. The last row is retrieved with **tail(1)** and placed in a new data frame. This row is the last customer that entered their information in the prototype and with this row new predictions will be made to give advice.

# In[ ]:


df2 = pd.read_sql("select * from customerdata", mydb).tail(1) #only select last row of data frame

df2.head()


# To put all new data with the same customer in the database, the customer's ID has been retrieved.

# In[ ]:


id_customer = df2['id'].to_string(index=False)
print(id_customer)


# With the data frame in which the last customer is placed, a prediction is made for the variable review score.

# In[ ]:


Xnew = df2[['loanPurpose', 'loanAmount', 'age', 'typeIncome', 'netIncome','agePartner','typeIncomePartner', 
               'netIncomePartner','children','positionProduct','consumptionValues', 'goals']]

ynew = rf.predict(Xnew) #make new prediction

Yrs = ''.join(str(e) for e in ynew)
Yrs = int(Yrs)
print(Yrs)


# ### Predicted probabilties
# Predicted probabilities looks at the probability of a class that is calculated from the algorithm. With the predicted probabilities I selected the top 3 highest predicted probabilities for the variable review score.

# In[ ]:


probs = rf.predict_proba(Xnew) #create predicted probabilties
probs = sorted( zip( rf.classes_, probs[0] ), key=lambda x:x[1] )[-3:] #show the top 3 predicted probabilties
probs


# These predicted probabilities have been added to new variables to be stored to the database later.

# In[ ]:


Yrs2 = probs[1]
Yrs2 = ' '.join(map(str, Yrs2))
Yrs2 = Yrs2[:2]
Yrs2 = int(Yrs2)
Yrs2


# In[ ]:


Yrs3 = probs[0]
Yrs3 = ' '.join(map(str, Yrs3))
Yrs3 = Yrs3[:2]
Yrs3 = int(Yrs3)
Yrs3


# ### Label highest review score
# To create the label highest review score for the prototype, the predicted probabilties that have the highest review score were examined. The highest review score was then stored in a new variable.

# In[ ]:


highestReviewScore = int(max(Yrs, Yrs2, Yrs3))
highestReviewScore = int(highestReviewScore)
print(highestReviewScore)


# ----
# ## Predicting variable interest rate
# The variable interest rate will be predicted with the new data of the prototype.

# In[ ]:


y = df['interestRate']#create the y-variable
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3, random_state=44) #split the data into test and training set


#Create a Gaussian Classifier
rf=RandomForestClassifier(bootstrap= True, max_depth= None, max_features= 3, min_samples_split= 8, n_estimators= 343)

#Train the model using the training sets y_pred=clf.predict(X_test)
rf=rf.fit(X_train,y_train)

y_pred_rs=rf.predict(X_test)


# With the data frame in which the last customer is placed, a prediction is made for the variable interest rate.

# In[ ]:


ynew = rf.predict(Xnew)

Yir = ''.join(str(e) for e in ynew) #make new prediction
Yir = int(Yir)
print(Yir)


# ### Predicted probabilties
# With the predicted probabilities I selected the top 3 highest predicted probabilities for the variable interest rate.

# In[ ]:


probs_Yir = rf.predict_proba(Xnew) #create predicted probabilties
probs_Yir = sorted( zip( rf.classes_, probs_Yir[0] ), key=lambda x:x[1] )[-3:] #show the top 3 predicted probabilties
probs_Yir


# These predicted probabilities have been added to new variables to be stored to the database later.

# In[ ]:


Yir2 = probs_Yir[1]
Yir2 = ' '.join(map(str, Yir2))
Yir2 = Yir2[:2]
Yir2 = int(Yir2)
Yir2


# In[ ]:


Yir3 = probs_Yir[0]
Yir3 = ' '.join(map(str, Yir3))
Yir3 = Yir3[:2]
Yir3 = int(Yir3)
Yir3


# ---
# ## Predicting variable type of loan
# The variable type of loan will be predicted with the new data of the prototype.

# In[ ]:


y = df['typeLoan']#create the y-variable
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3, random_state=44) #split the data into test and training set


#Create a Gaussian Classifier
rf=RandomForestClassifier(bootstrap= True, max_depth= None, max_features= 3, min_samples_split= 8, n_estimators= 343)

#Train the model using the training sets y_pred=clf.predict(X_test)
rf=rf.fit(X_train,y_train)

y_pred_rs=rf.predict(X_test)


# Based on the data analysis in the notebook *Data cleaning, data analysis and machine learning algorithms.ipynb*, it was noticed that type of loan has very few data records of the class revolving credit. Therefore, it was decided to only predict the class personal loan because this class is only correctly predicted.

# In[ ]:


ynew = rf.predict(Xnew)

Ytl = ''.join(str(e) for e in ynew) #make new prediction
Ytl = int(Ytl)
print(Ytl)


# ---
# ## Predicting variable loan duration
# The variable loan duration will be predicted with the new data of the prototype.

# In[ ]:


y = df['loanDuration']#create the y-variable
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3, random_state=44) #split the data into test and training set


#Create a Gaussian Classifier
rf=RandomForestClassifier(bootstrap= True, max_depth= None, max_features= 3, min_samples_split= 8, n_estimators= 343)

#Train the model using the training sets y_pred=clf.predict(X_test)
rf=rf.fit(X_train,y_train)

y_pred_rs=rf.predict(X_test)


# In[ ]:


ynew = rf.predict(Xnew)

Yld = ''.join(str(e) for e in ynew) #make new prediction
Yld = int(Yld)
print(Yld)


# ### Predicted probabilties
# With the predicted probabilities I selected the top 3 highest predicted probabilities for the variable loan duration.

# In[ ]:


probs_Yld = rf.predict_proba(Xnew) #create predicted probabilties
probs_Yld = sorted( zip( rf.classes_, probs_Yld[0] ), key=lambda x:x[1] )[-3:] #show the top 3 predicted probabilties
probs_Yld


# These predicted probabilities have been added to new variables to be stored to the database later.

# In[ ]:


Yld2 = probs_Yld[1]
Yld2 = ' '.join(map(str, Yld2))
Yld2 = Yld2[:2]
Yld2 = int(Yld2)
Yld2


# In[ ]:


Yld3 = probs_Yld[0]
Yld3 = ' '.join(map(str, Yld3))
Yld3 = Yld3[:2]
Yld3 = int(Yld3)
Yld3


# ### Label lowest loan duration
# To create the label lowest loan duration for the prototype, the predicted probabilties that have the lowest loan duration were examined. The lowest loan duration was then stored in a new variable.

# In[ ]:


lowestLoanDuration = int(min(Yld, Yld2, Yld3))
lowestLoanDuration = int(lowestLoanDuration)
print(lowestLoanDuration)


# ---
# ## Personalized persuasive information
# Based on the persuasion knowledge theory in the academic paper, it was important to create informative and subtle personalized persuasive information that leads to an improved decision quality. With each predicted advice, the personalized persuasive information shows how many customers with the same loan purpose have also applied for the same provider. 

# In[ ]:


loanPurpose = df2.iloc[0]['loanPurpose'] #show which loan purpose the new customer has
loanPurpose


# To find out how many customers with the same loan purpose per predicted advice chose the same provider, I calculated the number of rows that has the same loan purpose and same provider.

# In[ ]:


df_subset = df.loc[df['loanPurpose'] == loanPurpose] #create new data frame with rows that has the same loan purpose as the new customer
df_subset.head()


# In[ ]:


amountrows = df_subset.shape[0] #calculate the amount of rows with same loan purpose
amountrows


# In[ ]:


df_subset2 = df_subset.loc[df_subset['reviewScore'] == Yrs] #in the new data frame with the selected loan purpose, only select the rows with the same review score
df_subset2.head()


# In[ ]:


amountrows2 = df_subset2.shape[0] #calculate the amount of rows with same loan purpose and same review score
amountrows2


# This is also done with the other two loans that are predicted for the customer.

# In[ ]:


df_subset3 = df_subset.loc[df_subset['reviewScore'] == Yrs2] #in the new data frame with the selected loan purpose, only select the rows with the same review score of second loan
df_subset3.head()


# In[ ]:


amountrows3 = df_subset3.shape[0] #calculate the amount of rows with same loan purpose and same review score of second loan
amountrows3


# In[ ]:


df_subset4 = df_subset.loc[df_subset['reviewScore'] == Yrs3] #in the new data frame with the selected loan purpose, only select the rows with the same review score of third loan
df_subset4.head()


# In[ ]:


amountrows4 = df_subset4.shape[0] #calculate the amount of rows with same loan purpose and same review score of third loan
amountrows4


# ---
# ## Monthly amount
# With the new predicted advices, I calculated the monthly amount that the customer must pay.

# First I collected the total amount that the new customer has to pay.

# In[ ]:


loanAmount = df2.iloc[0]['loanAmount']
loanAmount


# Then I calculated the monthly amount for every predicted loan with the following formula:

# In[ ]:


monthamount = int(((loanAmount*Yir/100)+loanAmount)/Yld)
monthamount


# In[ ]:


monthamount2 = int(((loanAmount*Yir2/100)+loanAmount)/Yld2)
monthamount2


# In[ ]:


monthamount3 = int(((loanAmount*Yir3/100)+loanAmount)/Yld3)
monthamount3


# ---
# ## Store new data of customer in database
# By predicting all new data for the new customer, it can be stored in the database with table customerdata. With this data the results overview can be shown in the prototype.

# In[ ]:


mycursor = mydb.cursor()
#update new data of the customer
mycursor.execute("update customerdata set reviewScore = %s, reviewScore2 = %s, reviewScore3 = %s, interestRate = %s, interestRate2 = %s, interestRate3 = %s, typeLoan = %s, loanDuration = %s, loanDuration2 = %s, loanDuration3 = %s, highestReviewScore = %s, lowestLoanDuration = %s, persuasion = %s, persuasion2 = %s, persuasion3 = %s, monthamount = %s, monthamount2 = %s, monthamount3 = %s where id = %s;", (Yrs, Yrs2, Yrs3, Yir, Yir2, Yir3, Ytl, Yld, Yld2, Yld3, highestReviewScore, lowestLoanDuration, amountrows2, amountrows3, amountrows4, monthamount, monthamount2, monthamount3, id_customer))
