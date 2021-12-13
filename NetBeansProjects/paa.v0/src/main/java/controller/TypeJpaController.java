/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import controller.exceptions.IllegalOrphanException;
import controller.exceptions.NonexistentEntityException;
import java.io.Serializable;
import javax.persistence.Query;
import javax.persistence.EntityNotFoundException;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;
import entity.Maison;
import java.util.ArrayList;
import java.util.Collection;
import entity.Logement;
import entity.Type;
import java.util.List;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;

/**
 *
 * @author mathieudielna
 */
public class TypeJpaController implements Serializable {

    public TypeJpaController(EntityManagerFactory emf) {
        this.emf = emf;
    }
    private EntityManagerFactory emf = null;

    public EntityManager getEntityManager() {
        return emf.createEntityManager();
    }

    public void create(Type type) {
        if (type.getMaisonCollection() == null) {
            type.setMaisonCollection(new ArrayList<Maison>());
        }
        if (type.getLogementCollection() == null) {
            type.setLogementCollection(new ArrayList<Logement>());
        }
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            Collection<Maison> attachedMaisonCollection = new ArrayList<Maison>();
            for (Maison maisonCollectionMaisonToAttach : type.getMaisonCollection()) {
                maisonCollectionMaisonToAttach = em.getReference(maisonCollectionMaisonToAttach.getClass(), maisonCollectionMaisonToAttach.getIdLogement());
                attachedMaisonCollection.add(maisonCollectionMaisonToAttach);
            }
            type.setMaisonCollection(attachedMaisonCollection);
            Collection<Logement> attachedLogementCollection = new ArrayList<Logement>();
            for (Logement logementCollectionLogementToAttach : type.getLogementCollection()) {
                logementCollectionLogementToAttach = em.getReference(logementCollectionLogementToAttach.getClass(), logementCollectionLogementToAttach.getIdLogement());
                attachedLogementCollection.add(logementCollectionLogementToAttach);
            }
            type.setLogementCollection(attachedLogementCollection);
            em.persist(type);
            for (Maison maisonCollectionMaison : type.getMaisonCollection()) {
                Type oldIdTypeOfMaisonCollectionMaison = maisonCollectionMaison.getIdType();
                maisonCollectionMaison.setIdType(type);
                maisonCollectionMaison = em.merge(maisonCollectionMaison);
                if (oldIdTypeOfMaisonCollectionMaison != null) {
                    oldIdTypeOfMaisonCollectionMaison.getMaisonCollection().remove(maisonCollectionMaison);
                    oldIdTypeOfMaisonCollectionMaison = em.merge(oldIdTypeOfMaisonCollectionMaison);
                }
            }
            for (Logement logementCollectionLogement : type.getLogementCollection()) {
                Type oldIdTypeOfLogementCollectionLogement = logementCollectionLogement.getIdType();
                logementCollectionLogement.setIdType(type);
                logementCollectionLogement = em.merge(logementCollectionLogement);
                if (oldIdTypeOfLogementCollectionLogement != null) {
                    oldIdTypeOfLogementCollectionLogement.getLogementCollection().remove(logementCollectionLogement);
                    oldIdTypeOfLogementCollectionLogement = em.merge(oldIdTypeOfLogementCollectionLogement);
                }
            }
            em.getTransaction().commit();
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void edit(Type type) throws IllegalOrphanException, NonexistentEntityException, Exception {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            Type persistentType = em.find(Type.class, type.getIdType());
            Collection<Maison> maisonCollectionOld = persistentType.getMaisonCollection();
            Collection<Maison> maisonCollectionNew = type.getMaisonCollection();
            Collection<Logement> logementCollectionOld = persistentType.getLogementCollection();
            Collection<Logement> logementCollectionNew = type.getLogementCollection();
            List<String> illegalOrphanMessages = null;
            for (Maison maisonCollectionOldMaison : maisonCollectionOld) {
                if (!maisonCollectionNew.contains(maisonCollectionOldMaison)) {
                    if (illegalOrphanMessages == null) {
                        illegalOrphanMessages = new ArrayList<String>();
                    }
                    illegalOrphanMessages.add("You must retain Maison " + maisonCollectionOldMaison + " since its idType field is not nullable.");
                }
            }
            for (Logement logementCollectionOldLogement : logementCollectionOld) {
                if (!logementCollectionNew.contains(logementCollectionOldLogement)) {
                    if (illegalOrphanMessages == null) {
                        illegalOrphanMessages = new ArrayList<String>();
                    }
                    illegalOrphanMessages.add("You must retain Logement " + logementCollectionOldLogement + " since its idType field is not nullable.");
                }
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            Collection<Maison> attachedMaisonCollectionNew = new ArrayList<Maison>();
            for (Maison maisonCollectionNewMaisonToAttach : maisonCollectionNew) {
                maisonCollectionNewMaisonToAttach = em.getReference(maisonCollectionNewMaisonToAttach.getClass(), maisonCollectionNewMaisonToAttach.getIdLogement());
                attachedMaisonCollectionNew.add(maisonCollectionNewMaisonToAttach);
            }
            maisonCollectionNew = attachedMaisonCollectionNew;
            type.setMaisonCollection(maisonCollectionNew);
            Collection<Logement> attachedLogementCollectionNew = new ArrayList<Logement>();
            for (Logement logementCollectionNewLogementToAttach : logementCollectionNew) {
                logementCollectionNewLogementToAttach = em.getReference(logementCollectionNewLogementToAttach.getClass(), logementCollectionNewLogementToAttach.getIdLogement());
                attachedLogementCollectionNew.add(logementCollectionNewLogementToAttach);
            }
            logementCollectionNew = attachedLogementCollectionNew;
            type.setLogementCollection(logementCollectionNew);
            type = em.merge(type);
            for (Maison maisonCollectionNewMaison : maisonCollectionNew) {
                if (!maisonCollectionOld.contains(maisonCollectionNewMaison)) {
                    Type oldIdTypeOfMaisonCollectionNewMaison = maisonCollectionNewMaison.getIdType();
                    maisonCollectionNewMaison.setIdType(type);
                    maisonCollectionNewMaison = em.merge(maisonCollectionNewMaison);
                    if (oldIdTypeOfMaisonCollectionNewMaison != null && !oldIdTypeOfMaisonCollectionNewMaison.equals(type)) {
                        oldIdTypeOfMaisonCollectionNewMaison.getMaisonCollection().remove(maisonCollectionNewMaison);
                        oldIdTypeOfMaisonCollectionNewMaison = em.merge(oldIdTypeOfMaisonCollectionNewMaison);
                    }
                }
            }
            for (Logement logementCollectionNewLogement : logementCollectionNew) {
                if (!logementCollectionOld.contains(logementCollectionNewLogement)) {
                    Type oldIdTypeOfLogementCollectionNewLogement = logementCollectionNewLogement.getIdType();
                    logementCollectionNewLogement.setIdType(type);
                    logementCollectionNewLogement = em.merge(logementCollectionNewLogement);
                    if (oldIdTypeOfLogementCollectionNewLogement != null && !oldIdTypeOfLogementCollectionNewLogement.equals(type)) {
                        oldIdTypeOfLogementCollectionNewLogement.getLogementCollection().remove(logementCollectionNewLogement);
                        oldIdTypeOfLogementCollectionNewLogement = em.merge(oldIdTypeOfLogementCollectionNewLogement);
                    }
                }
            }
            em.getTransaction().commit();
        } catch (Exception ex) {
            String msg = ex.getLocalizedMessage();
            if (msg == null || msg.length() == 0) {
                Integer id = type.getIdType();
                if (findType(id) == null) {
                    throw new NonexistentEntityException("The type with id " + id + " no longer exists.");
                }
            }
            throw ex;
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void destroy(Integer id) throws IllegalOrphanException, NonexistentEntityException {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            Type type;
            try {
                type = em.getReference(Type.class, id);
                type.getIdType();
            } catch (EntityNotFoundException enfe) {
                throw new NonexistentEntityException("The type with id " + id + " no longer exists.", enfe);
            }
            List<String> illegalOrphanMessages = null;
            Collection<Maison> maisonCollectionOrphanCheck = type.getMaisonCollection();
            for (Maison maisonCollectionOrphanCheckMaison : maisonCollectionOrphanCheck) {
                if (illegalOrphanMessages == null) {
                    illegalOrphanMessages = new ArrayList<String>();
                }
                illegalOrphanMessages.add("This Type (" + type + ") cannot be destroyed since the Maison " + maisonCollectionOrphanCheckMaison + " in its maisonCollection field has a non-nullable idType field.");
            }
            Collection<Logement> logementCollectionOrphanCheck = type.getLogementCollection();
            for (Logement logementCollectionOrphanCheckLogement : logementCollectionOrphanCheck) {
                if (illegalOrphanMessages == null) {
                    illegalOrphanMessages = new ArrayList<String>();
                }
                illegalOrphanMessages.add("This Type (" + type + ") cannot be destroyed since the Logement " + logementCollectionOrphanCheckLogement + " in its logementCollection field has a non-nullable idType field.");
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            em.remove(type);
            em.getTransaction().commit();
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public List<Type> findTypeEntities() {
        return findTypeEntities(true, -1, -1);
    }

    public List<Type> findTypeEntities(int maxResults, int firstResult) {
        return findTypeEntities(false, maxResults, firstResult);
    }

    private List<Type> findTypeEntities(boolean all, int maxResults, int firstResult) {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            cq.select(cq.from(Type.class));
            Query q = em.createQuery(cq);
            if (!all) {
                q.setMaxResults(maxResults);
                q.setFirstResult(firstResult);
            }
            return q.getResultList();
        } finally {
            em.close();
        }
    }

    public Type findType(Integer id) {
        EntityManager em = getEntityManager();
        try {
            return em.find(Type.class, id);
        } finally {
            em.close();
        }
    }

    public int getTypeCount() {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            Root<Type> rt = cq.from(Type.class);
            cq.select(em.getCriteriaBuilder().count(rt));
            Query q = em.createQuery(cq);
            return ((Long) q.getSingleResult()).intValue();
        } finally {
            em.close();
        }
    }
    
}
