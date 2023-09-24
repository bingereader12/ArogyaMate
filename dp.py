import sys
import numpy as np
import pandas as pd

l1 = ['back_pain', 'constipation', 'abdominal_pain', 'diarrhoea', 'mild_fever', 'yellow_urine',
      'yellowing_of_eyes', 'acute_liver_failure', 'fluid_overload', 'swelling_of_stomach',
      'swelled_lymph_nodes', 'malaise', 'blurred_and_distorted_vision', 'phlegm', 'throat_irritation',
      'redness_of_eyes', 'sinus_pressure', 'runny_nose', 'congestion', 'chest_pain', 'weakness_in_limbs',
      'fast_heart_rate', 'pain_during_bowel_movements', 'pain_in_anal_region', 'bloody_stool',
      'irritation_in_anus', 'neck_pain', 'dizziness', 'cramps', 'bruising', 'obesity', 'swollen_legs',
      'swollen_blood_vessels', 'puffy_face_and_eyes', 'enlarged_thyroid', 'brittle_nails',
      'swollen_extremeties', 'excessive_hunger', 'extra_marital_contacts', 'drying_and_tingling_lips',
      'slurred_speech', 'knee_pain', 'hip_joint_pain', 'muscle_weakness', 'stiff_neck', 'swelling_joints',
      'movement_stiffness', 'spinning_movements', 'loss_of_balance', 'unsteadiness',
      'weakness_of_one_body_side', 'loss_of_smell', 'bladder_discomfort', 'foul_smell_of urine',
      'continuous_feel_of_urine', 'passage_of_gases', 'internal_itching', 'toxic_look_(typhos)',
      'depression', 'irritability', 'muscle_pain', 'altered_sensorium', 'red_spots_over_body', 'belly_pain',
      'abnormal_menstruation', 'dischromic _patches', 'watering_from_eyes', 'increased_appetite', 'polyuria', 'family_history', 'mucoid_sputum',
      'rusty_sputum', 'lack_of_concentration', 'visual_disturbances', 'receiving_blood_transfusion',
      'receiving_unsterile_injections', 'coma', 'stomach_bleeding', 'distention_of_abdomen',
      'history_of_alcohol_consumption', 'fluid_overload', 'blood_in_sputum', 'prominent_veins_on_calf',
      'palpitations', 'painful_walking', 'pus_filled_pimples', 'blackheads', 'scurring', 'skin_peeling',
      'silver_like_dusting', 'small_dents_in_nails', 'inflammatory_nails', 'blister', 'red_sore_around_nose',
      'yellow_crust_ooze']

disease = ['Fungal infection', 'Allergy', 'GERD', 'Chronic cholestasis', 'Drug Reaction',
           'Peptic ulcer diseae', 'AIDS', 'Diabetes', 'Gastroenteritis', 'Bronchial Asthma', 'Hypertension',
           ' Migraine', 'Cervical spondylosis',
           'Paralysis (brain hemorrhage)', 'Jaundice', 'Malaria', 'Chicken pox', 'Dengue', 'Typhoid', 'hepatitis A',
           'Hepatitis B', 'Hepatitis C', 'Hepatitis D', 'Hepatitis E', 'Alcoholic hepatitis', 'Tuberculosis',
           'Common Cold', 'Pneumonia', 'Dimorphic hemmorhoids(piles)',
           'Heartattack', 'Varicoseveins', 'Hypothyroidism', 'Hyperthyroidism', 'Hypoglycemia', 'Osteoarthristis',
           'Arthritis', '(vertigo) Paroymsal  Positional Vertigo', 'Acne', 'Urinary tract infection', 'Psoriasis',
           'Impetigo']
l2 = []

disease_info = {
    'Fungal infection': 'Fungal infections are caused by various types of fungi. To prevent fungal infections, maintain good hygiene, keep the skin dry, and avoid sharing personal items like towels and clothing with infected individuals.',
    'Allergy': 'Allergies occur when the immune system overreacts to allergens such as pollen, dust, or certain foods. Preventive measures include identifying and avoiding allergens, using antihistamines, and consulting with an allergist for treatment.',
    'GERD': 'GERD is a digestive disorder that causes acid reflux and heartburn. To prevent GERD, maintain a healthy weight, avoid large meals, and elevate the head of your bed when sleeping.',
    'Chronic cholestasis': 'Chronic cholestasis is a condition that affects the flow of bile from the liver. Preventive measures may include a healthy diet, weight management, and medical treatments.',
    'Drug Reaction': 'Drug reactions can occur as side effects of medications. Preventive measures include reading medication labels, informing healthcare providers of allergies, and monitoring for adverse reactions.',
    'Peptic ulcer disease': 'Peptic ulcers are open sores that develop on the lining of the stomach or the small intestine. Preventive measures include avoiding alcohol, tobacco, and certain medications that may exacerbate ulcers.',
    'AIDS': 'AIDS is a viral infection caused by HIV. Preventive measures include practicing safe sex, getting tested for HIV, and avoiding sharing needles or engaging in risky behaviors.',
    'Diabetes': 'Diabetes is a chronic condition that affects blood sugar levels. Preventive measures include maintaining a healthy diet, regular exercise, and monitoring blood sugar levels as recommended by a healthcare provider.',
    'Gastroenteritis': 'Gastroenteritis is an inflammation of the stomach and intestines. Preventive measures include practicing good hygiene, drinking clean water, and avoiding contaminated food.',
    'Bronchial Asthma': 'Bronchial asthma is a respiratory condition. Preventive measures include avoiding triggers, using prescribed inhalers, and having an asthma action plan.',
    'Hypertension': 'Hypertension, or high blood pressure, can be managed through lifestyle changes such as a low-sodium diet, regular exercise, and stress reduction techniques.',
    'Migraine': 'Migraine is a type of headache disorder. Preventive measures include identifying triggers, managing stress, and taking prescribed medications.',
    'Cervical spondylosis': 'Cervical spondylosis is a degenerative condition affecting the neck. Preventive measures include maintaining good posture, neck exercises, and avoiding excessive strain on the neck.',
    'Paralysis (brain hemorrhage)': 'Preventing brain hemorrhage-related paralysis involves managing risk factors like high blood pressure, cholesterol levels, and lifestyle choices like regular exercise and a healthy diet.',
    'Jaundice': 'Jaundice can be caused by various factors, including hepatitis and liver problems. Preventive measures depend on the underlying cause and may involve vaccination for hepatitis and practicing safe hygiene.',
    'Malaria': 'Malaria is a mosquito-borne disease. Preventive measures include using mosquito nets, applying insect repellent, and taking antimalarial medications when traveling to endemic areas.',
   'Chicken pox': 'Chickenpox is a highly contagious viral infection. Preventive measures include vaccination, isolation of infected individuals, and good hygiene practices.',
    'Dengue': 'Dengue is a mosquito-borne viral disease. Preventive measures include using mosquito repellent, eliminating mosquito breeding sites, and seeking medical attention for symptoms.',
    'Typhoid': 'Typhoid is a bacterial infection often spread through contaminated food or water. Preventive measures include practicing good hygiene, drinking clean water, and getting vaccinated.',
    'Hepatitis A': 'Hepatitis A is a viral liver infection. Preventive measures include vaccination, practicing good hand hygiene, and avoiding contaminated food and water.',
    'Hepatitis B': 'Hepatitis B is a viral liver infection. Preventive measures include vaccination, practicing safe sex, and avoiding sharing needles or personal items with infected individuals.',
    'Hepatitis C': 'Hepatitis C is a viral liver infection often transmitted through blood. Preventive measures include avoiding sharing needles, practicing safe sex, and getting tested for the virus.',
    'Hepatitis D': 'Hepatitis D is a liver infection that occurs in individuals with hepatitis B. Preventive measures include vaccination against hepatitis B.',
    'Hepatitis E': 'Hepatitis E is a viral liver infection. Preventive measures include practicing good hygiene, drinking clean water, and avoiding contaminated food.',
    'Alcoholic hepatitis': 'Alcoholic hepatitis is liver inflammation due to excessive alcohol consumption. Preventive measures involve limiting or avoiding alcohol consumption.',
    'Tuberculosis': 'Tuberculosis is a bacterial infection that primarily affects the lungs. Preventive measures include vaccination, early detection, and treatment of active cases.',
    'Common Cold': 'The common cold is caused by viruses and is highly contagious. Preventive measures include practicing good hygiene, such as handwashing, and avoiding close contact with infected individuals.',
    'Pneumonia': 'Pneumonia is a lung infection, often bacterial or viral. Preventive measures include vaccination, avoiding smoking, and practicing good respiratory hygiene.',
    'Dimorphic hemmorhoids(piles)': 'Preventive measures for hemorrhoids include maintaining a high-fiber diet, staying hydrated, and avoiding excessive straining during bowel movements.',
    'Heart attack': 'Preventive measures for heart attacks include a heart-healthy diet, regular exercise, managing stress, and controlling risk factors like high blood pressure and cholesterol.',
    'Varicose veins': 'Preventive measures for varicose veins include maintaining a healthy weight, regular exercise, elevating the legs, and wearing compression stockings.',
    'Hypothyroidism': 'Hypothyroidism is a thyroid disorder. Preventive measures include a balanced diet, regular exercise, and medication management if diagnosed.',
    'Hyperthyroidism': 'Hyperthyroidism is a thyroid disorder. Preventive measures involve managing the condition through medications, surgery, or radioactive iodine treatment.',
    'Hypoglycemia': 'Hypoglycemia, or low blood sugar, can be prevented by managing diabetes carefully through diet, medication, and blood sugar monitoring.',
    'Osteoarthristis': 'Preventive measures for osteoarthritis include maintaining a healthy weight, regular exercise, and protecting joints from excessive wear and tear.',
    'Arthritis': 'Arthritis prevention involves lifestyle changes such as maintaining a healthy weight, regular exercise, and managing joint pain.',
    '(vertigo) Paroymsal Positional Vertigo': 'Preventive measures for vertigo include avoiding sudden head movements and following prescribed treatments.',
    'Acne': 'Preventive measures for acne include proper skincare, avoiding picking or squeezing pimples, and managing stress.',
    'Urinary tract infection': 'Preventive measures for UTIs include staying hydrated, practicing good hygiene, and urinating before and after sexual activity.',
    'Psoriasis': 'Psoriasis management includes moisturizing, avoiding triggers, and following prescribed treatments. Stress management is also essential.',
    'Impetigo': 'Impetigo prevention involves good hygiene, keeping sores covered, and avoiding contact with infected individuals.',
}


for i in range(0, len(l1)):
    l2.append(0)

df = pd.read_csv("Prototype.csv") #test
df.replace({'prognosis': {'Fungal infection': 0, 'Allergy': 1, 'GERD': 2, 'Chronic cholestasis': 3, 'Drug Reaction': 4,
                          'Peptic ulcer diseae': 5, 'AIDS': 6, 'Diabetes ': 7, 'Gastroenteritis': 8, 'Bronchial Asthma': 9, 'Hypertension ': 10,
                          'Migraine': 11, 'Cervical spondylosis': 12,
                          'Paralysis (brain hemorrhage)': 13, 'Jaundice': 14, 'Malaria': 15, 'Chicken pox': 16, 'Dengue': 17, 'Typhoid': 18, 'hepatitis A': 19,
                          'Hepatitis B': 20, 'Hepatitis C': 21, 'Hepatitis D': 22, 'Hepatitis E': 23, 'Alcoholic hepatitis': 24, 'Tuberculosis': 25,
                          'Common Cold': 26, 'Pneumonia': 27, 'Dimorphic hemmorhoids(piles)': 28, 'Heart attack': 29, 'Varicose veins': 30, 'Hypothyroidism': 31,
                          'Hyperthyroidism': 32, 'Hypoglycemia': 33, 'Osteoarthristis': 34, 'Arthritis': 35,
                          '(vertigo) Paroymsal  Positional Vertigo': 36, 'Acne': 37, 'Urinary tract infection': 38, 'Psoriasis': 39,
                          'Impetigo': 40}}, inplace=True)

X = df[l1]  # print df head
y = df[["prognosis"]]
np.ravel(y)

tr = pd.read_csv("Prototype.csv") #training
tr.replace({'prognosis': {'Fungal infection': 0, 'Allergy': 1, 'GERD': 2, 'Chronic cholestasis': 3, 'Drug Reaction': 4,
                          'Peptic ulcer diseae': 5, 'AIDS': 6, 'Diabetes ': 7, 'Gastroenteritis': 8, 'Bronchial Asthma': 9, 'Hypertension ': 10,
                          'Migraine': 11, 'Cervical spondylosis': 12,
                          'Paralysis (brain hemorrhage)': 13, 'Jaundice': 14, 'Malaria': 15, 'Chicken pox': 16, 'Dengue': 17, 'Typhoid': 18, 'hepatitis A': 19,
                          'Hepatitis B': 20, 'Hepatitis C': 21, 'Hepatitis D': 22, 'Hepatitis E': 23, 'Alcoholic hepatitis': 24, 'Tuberculosis': 25,
                          'Common Cold': 26, 'Pneumonia': 27, 'Dimorphic hemmorhoids(piles)': 28, 'Heart attack': 29, 'Varicose veins': 30, 'Hypothyroidism': 31,
                          'Hyperthyroidism': 32, 'Hypoglycemia': 33, 'Osteoarthristis': 34, 'Arthritis': 35,
                          '(vertigo) Paroymsal  Positional Vertigo': 36, 'Acne': 37, 'Urinary tract infection': 38, 'Psoriasis': 39,
                          'Impetigo': 40}}, inplace=True)

X_test = tr[l1]
y_test = tr[["prognosis"]]
np.ravel(y_test)

S1 = sys.argv[1]
S2 = sys.argv[2]
S3 = sys.argv[3]

def randomforest():
    from sklearn.ensemble import RandomForestClassifier
    alg = RandomForestClassifier()
    alg = alg.fit(X, np.ravel(y))
    from sklearn.metrics import accuracy_score
    y_pred = alg.predict(X_test)
    # print(accuracy_score(y_test, y_pred))
    # print(accuracy_score(y_test, y_pred, normalize=False))
    psymptoms = [S1,S2,S3]
    for k in range(0, len(l1)):
        for z in psymptoms:
            if(z == l1[k]):
                l2[k] = 1
    inputtest = [l2]
    predict = alg.predict(inputtest)
    predicted = predict[0]
    h = 'no'
    for a in range(0, len(disease)):
        if(predicted == a):
            h = 'yes'
            break
    if (h == 'yes'):
        print(disease[a])
    else:
        print("Not Found")

randomforest()